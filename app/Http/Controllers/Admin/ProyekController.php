<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use App\Models\User;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     * Admin can view all projects from all staff (monitoring only)
     */
    public function index(Request $request)
    {
        $query = Proyek::query();

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

        // Filter by staff
        if ($request->has('staff_id') && $request->staff_id) {
            $query->where('user_id', $request->staff_id);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $proyeks = $query->with('user')->paginate(10)->withQueryString();
        $staffList = User::where('role', 'staff')->get();

        return view('admin.proyek.index', compact('proyeks', 'staffList'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyek $proyek)
    {
        return view('admin.proyek.show', compact('proyek'));
    }

    /**
     * Show the form for editing the specified resource.
     * Hanya admin yang boleh mengubah status & progress
     */
    public function edit(Proyek $proyek)
    {
        return view('admin.proyek.edit', compact('proyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyek $proyek)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mahasiswa_nim' => 'required|string|max:10|min:10',
            'mahasiswa_nama' => 'required|string|max:255',
            'dosen_pembimbing' => 'required|string|max:255',
            'status' => 'required|in:pending,on_progress,completed,rejected', // Hanya admin yang bisa mengubah status
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'progress' => 'nullable|integer|min:0|max:100', // Hanya admin yang bisa mengubah progress
            'catatan' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_lampiran.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Handle single file upload
        if ($request->hasFile('file_dokumen')) {
            if ($proyek->file_dokumen) {
                \Storage::disk('public')->delete($proyek->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('proyeks/dokumen', 'public');
        }

        // Handle multiple file uploads
        if ($request->hasFile('file_lampiran')) {
            if ($proyek->file_lampiran) {
                foreach ($proyek->file_lampiran as $file) {
                    \Storage::disk('public')->delete($file);
                }
            }
            $files = [];
            foreach ($request->file('file_lampiran') as $file) {
                $files[] = $file->store('proyeks/lampiran', 'public');
            }
            $validated['file_lampiran'] = $files;
        }

        $proyek->update($validated);

        return redirect()
            ->route('admin.proyek.show', $proyek)
            ->with('success', 'Proyek berhasil diperbarui oleh admin.');
    }

    /**
     * Monitoring staff performance
     */
    public function monitoringStaff(Request $request)
    {
        $query = User::where('role', 'staff');

        // Search staff
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Hanya ambil count; hindari eager load dengan limit yang memicu SQL variabel (laravel_row) di MySQL lama
        $staffs = $query->withCount([
            'proyeks as proyeks_completed_count' => function($q) {
                $q->where('status', 'completed');
            },
            'proyeks as proyeks_total_count'
        ])->paginate(10)->withQueryString();

        return view('admin.staff.monitoring', compact('staffs'));
    }

    /**
     * Detail staff dengan proyek-proyeknya
     */
    public function staffDetail(User $user)
    {
        if ($user->role !== 'staff') {
            abort(403, 'User ini bukan staff.');
        }

        $proyeks = Proyek::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Proyek::where('user_id', $user->id)->count(),
            'pending' => Proyek::where('user_id', $user->id)->where('status', 'pending')->count(),
            'on_progress' => Proyek::where('user_id', $user->id)->where('status', 'on_progress')->count(),
            'completed' => Proyek::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];

        return view('admin.staff.detail', compact('user', 'proyeks', 'stats'));
    }
}
