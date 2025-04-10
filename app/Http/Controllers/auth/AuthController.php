<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return (Auth::user()->role === 'admin')
                ? redirect()->route('admin.index')
                : redirect()->route('supervisor.index');
        }
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            session(['username' => $user->username, 'role' => $user->role]);
            session()->flash('success', 'Login berhasil. Selamat datang, ' . $user->username . '!');
        
            return ($user->role === 'admin')
                ? redirect()->route('admin.index')
                : redirect()->route('supervisor.index');
        }
        
        return back()->with('error', 'Cek Username dan Password Anda Lagi');   
    }
}
