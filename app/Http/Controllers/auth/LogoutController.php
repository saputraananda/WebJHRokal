<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        Session::flush(); // Hapus semua session

        return redirect()->route('auth.login')->with('success', 'Berhasil Logout!');
    }
}
