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
        $peminjaman = asset_status::with(['peti.customer', 'peti.tipe_peti', 'warehouse'])->find($id);

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil diambil ID',
            'asset_status' => $peminjaman
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'peti_id' => 'required',
            'exit_at' => 'required',
            'exit_pic' => 'required',
            'exit_warehouse' => 'required',
            'est_pengembalian' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
        ]);

        $peminjaman = asset_status::create([
            'peti_id' => $request->peti_id,
            'exit_at' => $request->exit_at,
            'exit_pic' => $request->exit_pic,
            'exit_warehouse' => $request->exit_warehouse,
            'est_pengembalian' => $request->est_pengembalian,
            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        ]);

        return ResponseFormatter::success([
            'message' => 'Data peminjaman berhasil ditambahkan',
            'peminjam' => $peminjaman
        ]);
    }
}
