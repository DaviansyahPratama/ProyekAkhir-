<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProyekController as AdminProyekController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Staff\ProyekController as StaffProyekController;
use App\Http\Controllers\Guest\ProyekController as GuestProyekController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/skip-login', [AuthController::class, 'skipLogin'])->name('skip-login');

// Dashboard - Public or Authenticated based on login status
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Unauthorized access page
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Proyek management
    Route::get('proyek', [AdminProyekController::class, 'index'])->name('proyek.index');
    Route::get('proyek/{proyek}', [AdminProyekController::class, 'show'])->name('proyek.show');
    Route::get('proyek/{proyek}/edit', [AdminProyekController::class, 'edit'])->name('proyek.edit');
    Route::put('proyek/{proyek}', [AdminProyekController::class, 'update'])->name('proyek.update');
    
    // Staff monitoring
    Route::get('staff', [AdminProyekController::class, 'monitoringStaff'])->name('staff.monitoring');
    Route::get('staff/{user}', [AdminProyekController::class, 'staffDetail'])->name('staff.detail');
    
    // User management
    Route::resource('user', AdminUserController::class);
});

// Staff routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    // Proyek management (limited)
    Route::resource('proyek', StaffProyekController::class);
});

// Guest routes (authenticated guests)
Route::middleware(['auth', 'role:guest'])->prefix('guest')->name('guest.')->group(function () {
    // View only
    Route::get('proyek', [GuestProyekController::class, 'index'])->name('proyek.index');
    Route::get('proyek/{proyek}', [GuestProyekController::class, 'show'])->name('proyek.show');
});

// Public guest routes (no authentication required) - untuk guest yang tidak login
Route::prefix('public')->name('public.')->group(function () {
    Route::get('proyek', [GuestProyekController::class, 'publicIndex'])->name('proyek.index');
    Route::get('proyek/{proyek}', [GuestProyekController::class, 'publicShow'])->name('proyek.show');
});
