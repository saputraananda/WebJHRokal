<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isSupervisor()) {
                return redirect()->route('supervisor.dashboard');
            }
        }

        return back()->withErrors(['loginError' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
