<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectAuthController extends Controller
{
    public function redirectAuth()
    {
        if (Auth::check() && Auth::user()->role_id == '1') {
            // Admin
            return redirect()->route('dashboard.home.admin');
        } elseif (Auth::check() && Auth::user()->role_id == 'user') {
            return redirect()->route('dashboard.home.user');
        } else {
            return redirect()->route('login');
        }
    }
}
