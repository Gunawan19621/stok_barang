<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\m_asset;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Bkeluar = BarangKeluar::all();
        $asset = m_asset::all();
        return view('dashboard.transaksi.barang_keluar', compact('Bkeluar', 'asset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('masuk');
        $request->validate([
            'asset_id' => 'required',
            'jumlah' => 'required',
            'tanggal_keluar' => 'required',
            'penerima_barang' => 'required',
            'exit_warehouse' => 'required',
            'keterangan' => 'required',
        ]);
        // dd($request);
        try {
            $validatedData = $request->except('_token');
            // dd($validatedData);
            BarangKeluar::create($validatedData);
            return redirect()->back()->with('success', 'Data barang keluar berhasil ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data barang keluar gagal ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($barang_masuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($barang_masuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $barang_masuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $asset = BarangKeluar::findOrFail($id);
            $asset->delete();
            return redirect()->back()->with('success', 'Data Barang Keluar berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Barang Keluar gagal dihapus');
        }
    }
}
