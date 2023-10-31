<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectAuthController extends Controller
{
    public function redirectAuth()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == '1') {
                // Admin
                return redirect()->route('dashboard.home.admin');
            } else {
                return redirect()->route('dashboard.home.admin');
                // User (role_id selain 1)
                // return redirect()->route('dashboard.home.user');
            }
        } else {
            // Tidak ada akun atau kesalahan login
            // return redirect()->route('login')->with('error', 'Kesalahan email atau password.');
            return redirect()->route('login')->with('error', 'Kesalahan email atau password.');
        }

        // if (Auth::check() && Auth::user()->role_id == '1') {
        //     // Admin
        //     return redirect()->route('dashboard.home.admin');
        // } elseif (Auth::check() && Auth::user()->role_id == '2') {
        //     return redirect()->route('dashboard.home.admin');
        //     // return redirect()->route('dashboard.home.user');
        // } else {
        //     return redirect()->route('login');
        // }
    }
}
