<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard - Public if not logged in, Authenticated if logged in
     */
    public function index()
    {
        // If not logged in, show public dashboard
        if (!Auth::check()) {
            $totalProyeks = Proyek::where('status', 'completed')->count();
            $recentProyeks = Proyek::where('status', 'completed')->latest()->take(6)->get();
            return view('public.dashboard', compact('totalProyeks', 'recentProyeks'));
        }
        
        // If logged in, show dashboard based on role
        $user = Auth::user();

        if ($user->isAdmin()) {
            $totalProyeks = Proyek::count();
            $proyeksPending = Proyek::where('status', 'pending')->count();
            $proyeksOnProgress = Proyek::where('status', 'on_progress')->count();
            $proyeksCompleted = Proyek::where('status', 'completed')->count();
            $totalUsers = User::count();
            $totalStaff = User::where('role', 'staff')->count();
            $recentProyeks = Proyek::with('user')->latest()->take(5)->get();

            return view('admin.dashboard', compact(
                'totalProyeks',
                'proyeksPending',
                'proyeksOnProgress',
                'proyeksCompleted',
                'totalUsers',
                'totalStaff',
                'recentProyeks'
            ));
        } elseif ($user->isStaff()) {
            $totalProyeks = Proyek::where('user_id', $user->id)->count();
            $proyeksPending = Proyek::where('user_id', $user->id)->where('status', 'pending')->count();
            $proyeksOnProgress = Proyek::where('user_id', $user->id)->where('status', 'on_progress')->count();
            $proyeksCompleted = Proyek::where('user_id', $user->id)->where('status', 'completed')->count();
            $myRecentProyeks = Proyek::where('user_id', $user->id)->latest()->take(5)->get();

            return view('staff.dashboard', compact(
                'totalProyeks',
                'proyeksPending',
                'proyeksOnProgress',
                'proyeksCompleted',
                'myRecentProyeks'
            ));
        } else {
            // Guest dashboard
            $totalProyeks = Proyek::where('status', 'completed')->count();
            $recentProyeks = Proyek::where('status', 'completed')->latest()->take(6)->get();

            return view('guest.dashboard', compact('totalProyeks', 'recentProyeks'));
        }
    }
}
