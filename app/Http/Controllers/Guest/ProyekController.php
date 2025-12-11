<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     * Guest can only view public information (view only)
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

        // Guest can only see completed projects
        $query->where('status', 'completed');

        $proyeks = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('guest.proyek.index', compact('proyeks'));
    }

    /**
     * Display the specified resource.
     * Guest can only view (view only)
     */
    public function show(Proyek $proyek)
    {
        // Guest can only view completed projects
        if ($proyek->status !== 'completed') {
            abort(403, 'Proyek ini belum tersedia untuk dilihat.');
        }

        return view('guest.proyek.show', compact('proyek'));
    }

    /**
     * Display a listing of the resource for public (no login required).
     */
    public function publicIndex(Request $request)
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

        // Public can only see completed projects
        $query->where('status', 'completed');

        $proyeks = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('public.proyek.index', compact('proyeks'));
    }

    /**
     * Display the specified resource for public (no login required).
     */
    public function publicShow(Proyek $proyek)
    {
        // Public can only view completed projects
        if ($proyek->status !== 'completed') {
            abort(403, 'Proyek ini belum tersedia untuk dilihat.');
        }

        return view('public.proyek.show', compact('proyek'));
    }
}
