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
        $peminjaman = \App\Models\asset_status::with(['asset', 'warehouse'])->get();

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil diambil',
            'peminjam' => $peminjaman
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'asset_id' => 'required',
            'exit_at' => 'required',
            'exit_pic' => 'required',
            'exit_warehouse' => 'required',
        ]);

        $data = $request->all();

        $peminjaman = asset_status::create($data);

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil ditambahkan',
            'peminjam' => $peminjaman
        ]);
    }
}
