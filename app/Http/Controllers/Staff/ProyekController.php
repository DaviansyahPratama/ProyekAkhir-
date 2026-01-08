<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     * Staff can only see their own projects
     */
    public function index(Request $request)
    {
        $query = Proyek::where('user_id', Auth::id());

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('mahasiswa_nim', 'like', "%{$search}%")
                  ->orWhere('mahasiswa_nama', 'like', "%{$search}%")
                  ->orWhere('dosen_pembimbing', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $proyeks = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('staff.proyek.index', compact('proyeks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_nim' => 'required|string|max:10|min:10',
            'mahasiswa_nama' => 'required|string|max:255',
            'dosen_pembimbing' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            // status & progress ditentukan oleh admin, bukan mahasiswa
            'catatan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_lampiran.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Assign to current staff
        $validated['user_id'] = Auth::id();

        // Default progress & status: mahasiswa tidak bisa menentukan sendiri
        $validated['status'] = 'pending';
        $validated['progress'] = 0;

        // Handle single file upload
        if ($request->hasFile('file_dokumen')) {
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('proyeks/dokumen', 'public');
        }

        // Handle multiple file uploads
        if ($request->hasFile('file_lampiran')) {
            $files = [];
            foreach ($request->file('file_lampiran') as $file) {
                $files[] = $file->store('proyeks/lampiran', 'public');
            }
            $validated['file_lampiran'] = $files;
        }

        Proyek::create($validated);

        return redirect()->route('staff.proyek.index')
            ->with('success', 'Proyek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        // Staff can only view their own projects
        if ($proyek->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat proyek ini.');
        }

        return view('staff.proyek.show', compact('proyek'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyek $proyek)
    {
        // Staff can only edit their own projects
        if ($proyek->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit proyek ini.');
        }
        
        return view('staff.proyek.edit', compact('proyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyek $proyek)
    {
        // Staff can only update their own projects
        if ($proyek->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate proyek ini.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_nim' => 'required|string|max:10|min:10',
            'mahasiswa_nama' => 'required|string|max:255',
            'dosen_pembimbing' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            // status & progress TIDAK ada di sini karena hanya bisa diubah admin
            'catatan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_lampiran.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Handle single file upload
        if ($request->hasFile('file_dokumen')) {
            if ($proyek->file_dokumen) {
                Storage::disk('public')->delete($proyek->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('proyeks/dokumen', 'public');
        }

        // Handle multiple file uploads
        if ($request->hasFile('file_lampiran')) {
            if ($proyek->file_lampiran) {
                foreach ($proyek->file_lampiran as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
            $files = [];
            foreach ($request->file('file_lampiran') as $file) {
                $files[] = $file->store('proyeks/lampiran', 'public');
            }
            $validated['file_lampiran'] = $files;
        }

        // KEAMANAN: Pastikan status & progress tidak berubah dari sisi staff
        // Meskipun ada yang mencoba kirim data ini, akan diabaikan
        if ($request->has('status') || $request->has('progress')) {
            // Hapus dari validated untuk memastikan tidak ter-update
            unset($validated['status'], $validated['progress']);
        }

        $proyek->update($validated);

        return redirect()->route('staff.proyek.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyek $proyek)
    {
        // Staff can only delete their own projects
        if ($proyek->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus proyek ini.');
        }

        // Delete files
        if ($proyek->file_dokumen) {
            Storage::disk('public')->delete($proyek->file_dokumen);
        }
        if ($proyek->file_lampiran) {
            foreach ($proyek->file_lampiran as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $proyek->delete();

        return redirect()->route('staff.proyek.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
