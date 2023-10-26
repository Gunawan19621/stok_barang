<?php

namespace App\Http\Controllers\API\v1\PeminjamanApi;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\asset_status;
use App\Models\BarangMasuk;

class PeminjamanApiController extends Controller
{
    public function index()
    {
        $peminjaman = \App\Models\asset_status::get();

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil diambil',
            'peminjam' => $peminjaman
        ]);
    }
}
