<?php

use App\Http\Controllers\Auth\AuthController;
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
Route::get('/', function () {
    return redirect('/login');
});

// Halaman Login
Route::get('/login', function () {
    if (Auth::check()) {
        return (Auth::user()->role === 'admin')
            ? redirect()->route('transaksi.index')
            : redirect()->route('supervisor.index');
    }
    return view('auth.login');
})->name('auth.login');

// Proses Login
Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Cek apakah username ada dalam tabel users dan password valid
    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        $user = Auth::user();
        session(['username' => $user->username, 'role' => $user->role]);

        // Redirect berdasarkan role
        return ($user->role === 'admin')
            ? redirect()->route('transaksi.index')
            : redirect()->route('supervisor.index');
    }

    // Jika gagal, kembali ke halaman login dengan pesan error
    return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
})->name('login');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    Session::flush(); // Hapus semua session
    return redirect()->route('auth.login')
                     ->with('success', 'Anda berhasil logout.');
})->name('logout');


// ==========================
// RUTE UNTUK ADMIN (TRANSAKSI)
// ==========================
Route::middleware(['auth', 'role:admin','nocache'])->group(function () {
    Route::get('/dashboard', [TransaksiController::class, 'index'])->name('transaksi.index');

    Route::get('/prediksi', function () {
        return view('transaksi.predict');
    })->name('transaksi.predict');

    Route::get('/penjualan', [TransaksiController::class, 'penjualan'])->name('transaksi.penjualan');
    Route::get('/retur', [TransaksiController::class, 'retur'])->name('transaksi.retur');
    Route::get('/setor', [TransaksiController::class, 'setor'])->name('transaksi.setor');

    // Tambah Transaksi
    Route::get('/tambah', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/', [TransaksiController::class, 'store'])->name('transaksi.store');

    // Edit & Update Transaksi
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

    // Hapus Transaksi
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});

// ==========================
// RUTE UNTUK SUPERVISOR
// ==========================
Route::middleware(['auth', 'role:supervisor','nocache'])->group(function () {
    Route::get('supervisor/', function () {
        return view('supervisor.index');
    })->name('supervisor.index');

    Route::get('/supervisor/penjualan', [TransaksiController::class, 'penjualanSupervisor'])->name('supervisor.penjualan');
    Route::get('/supervisor/retur', [TransaksiController::class, 'returSupervisor'])->name('supervisor.retur');
    Route::get('/supervisor/setor', [TransaksiController::class, 'setorSupervisor'])->name('supervisor.setor');
    Route::get('/supervisor/predict', function () {
        return view('supervisor.predict');
    })->name('supervisor.predict');
});
