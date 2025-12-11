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
     * Admin can only view, cannot edit
     */
    public function show(Proyek $proyek)
    {
        return view('admin.proyek.show', compact('proyek'));
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
