<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'reminder' => \App\Models\asset_status::whereNull('enter_at')->count(),
            'jumlahAsset' => \App\Models\m_asset::count(),
            'jumlahPeminjaman' => \App\Models\asset_status::count(),
            'jumlahPengembalian' => \App\Models\asset_status::whereNotNull('enter_at')->count(),
            'active' => 'menu-dashboard',
        ];

        return view('dashboard.index', $data);
    }
}
