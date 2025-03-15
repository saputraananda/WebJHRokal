<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;

// ==========================
// RUTE UNTUK LOGIN & LOGOUT
// ==========================


// ✅ Saat user buka website, langsung ke /login
Route::get('/', function () {return redirect('/login');});

// Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');

// Proses Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


// ==========================
// RUTE UNTUK ADMIN 
// ==========================
Route::middleware(['auth', 'role:admin','nocache'])->group(function () {
    Route::get('/dashboard', [TransaksiController::class, 'index'])->name('admin.index');

    Route::get('/prediksi', function () {return view('admin.predict');})->name('admin.predict');

    Route::get('/penjualan', [TransaksiController::class, 'penjualan'])->name('admin.penjualan');
    Route::get('/retur', [TransaksiController::class, 'retur'])->name('admin.retur');
    Route::get('/setor', [TransaksiController::class, 'setor'])->name('admin.setor');

    // Tambah Transaksi
    Route::get('/tambah', [TransaksiController::class, 'create'])->name('admin.create');
    Route::post('/', [TransaksiController::class, 'store'])->name('admin.store');

    // Edit & Update Transaksi
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('admin.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('admin.update');

    // Hapus Transaksi
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('admin.destroy');
});

// ==========================
// RUTE UNTUK SUPERVISOR
// ==========================
Route::middleware(['auth', 'role:supervisor','nocache'])->group(function () {
    Route::get('supervisor/', function () {return view('supervisor.index');})->name('supervisor.index');
    Route::get('/supervisor/penjualan', [TransaksiController::class, 'penjualanSupervisor'])->name('supervisor.penjualan');
    Route::get('/supervisor/retur', [TransaksiController::class, 'returSupervisor'])->name('supervisor.retur');
    Route::get('/supervisor/setor', [TransaksiController::class, 'setorSupervisor'])->name('supervisor.setor');
    Route::get('/supervisor/predict', function () {return view('supervisor.predict');})->name('supervisor.predict');
});
