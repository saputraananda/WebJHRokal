<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\ForecastController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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
    Route::get('admin/dashboard', [AdminController::class, 'getScorecard'])->name('admin.index');
    Route::get('admin/prediksi', [ForecastController::class, 'index'])->name('admin.predict');
    Route::get('admin/penjualan', [AdminController::class, 'getPenjualanAdmin'])->name('admin.penjualan');
    Route::get('admin/retur', [AdminController::class, 'retur'])->name('admin.retur');
    Route::get('admin/piutang', [AdminController::class, 'piutang'])->name('admin.piutang');

    // Tambah Transaksi
    Route::get('admin/tambah', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/', [AdminController::class, 'store'])->name('admin.store');

    // Edit & Update Transaksi
    Route::get('/transaksi/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/transaksi/{id}', [AdminController::class, 'update'])->name('admin.update');

    // Hapus Transaksi
    Route::delete('/transaksi/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Detail Transaksi
    Route::get('/transaksi/{id}/detail', [AdminController::class, 'detail'])->name('admin.detail');
});

// ==========================
// RUTE UNTUK SUPERVISOR
// ==========================
Route::middleware(['auth', 'role:supervisor','nocache'])->group(function () {
    Route::get('/supervisor',  [SupervisorController::class, 'getScoreCard'])->name('supervisor.index');
    Route::get('/supervisor/penjualan', [SupervisorController::class, 'getpenjualanSupervisor'])->name('supervisor.penjualan');
    Route::get('/supervisor/{id}/detail', [SupervisorController::class, 'getDetailSupervisor'])->name('supervisor.detail');
    Route::get('/supervisor/retur', [SupervisorController::class, 'getReturSupervisor'])->name('supervisor.retur');
    Route::get('/supervisor/piutang', [SupervisorController::class, 'getPiutangSupervisor'])->name('supervisor.piutang');
    Route::get('/supervisor/predict', [ForecastController::class, 'index'])->name('supervisor.predict');
});