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

    public function generateChartData()
    {
        $months = [];
        $exitData = [];
        $enterData = [];

        $monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("F", mktime(0, 0, 0, $i, 1));

            $exitCount = \App\Models\asset_status::whereMonth('exit_at', $i)->count();
            $enterCount = \App\Models\asset_status::whereMonth('enter_at', $i)->count();

            $exitData[] = $exitCount;
            $enterData[] = $enterCount;
        }

        return compact('months', 'exitData', 'enterData', 'monthNames');
    }
}
