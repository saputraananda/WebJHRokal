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
    Route::get('/dashboard', [AdminController::class, 'getScorecard'])->name('admin.index');

    Route::get('/prediksi', [ForecastController::class, 'index'])->name('admin.predict');

    Route::get('/penjualan', [AdminController::class, 'getPenjualanAdmin'])->name('admin.penjualan');
    Route::get('/retur', [AdminController::class, 'retur'])->name('admin.retur');
    Route::get('/piutang', [AdminController::class, 'piutang'])->name('admin.piutang');

    // Tambah Transaksi
    Route::get('/tambah', [AdminController::class, 'create'])->name('admin.create');
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
    Route::get('/supervisor', function () {return view('supervisor.index');})->name('supervisor.index');
    Route::get('/supervisor/penjualan', [SupervisorController::class, 'penjualanSupervisor'])->name('supervisor.penjualan');
    Route::get('/supervisor/retur', [SupervisorController::class, 'returSupervisor'])->name('supervisor.retur');
    Route::get('/supervisor/setor', [SupervisorController::class, 'setorSupervisor'])->name('supervisor.setor');
    Route::get('/supervisor/predict', function () {return view('supervisor.predict');})->name('supervisor.predict');
});