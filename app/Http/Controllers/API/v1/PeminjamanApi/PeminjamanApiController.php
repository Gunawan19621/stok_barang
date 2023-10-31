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
        $peminjaman = \App\Models\asset_status::with(['peti.customer', 'peti.tipe_peti', 'warehouse'])->get();

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil diambil',
            'asset_status' => $peminjaman
        ]);
    }

    public function show($id)
    {
        $peminjaman = asset_status::with(['peti',  'warehouse'])->find($id);

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil diambil ID',
            'asset_status' => $peminjaman
        ]);
    }

    public function store(Request $request)
    {

        $peminjaman = asset_status::create([
            'asset_id' => $request->asset_id,
            'exit_at' => $request->exit_at,
            'exit_pic' => $request->exit_pic,
            'exit_warehouse' => $request->exit_warehouse,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        ]);

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil ditambahkan',
            'peminjam' => $peminjaman
        ]);
    }
}
