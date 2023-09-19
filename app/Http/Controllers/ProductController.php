<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = product::get();
        return view('addons.settingplatform', compact('product'));
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
        // Mendapatkan produk terbaru
        $latestProduct = \App\Models\Product::latest()->first();
        // Mendapatkan tahun saat ini
        $currentYear = date("Y");
        // Menghitung nomor urut untuk kode barang
        if ($latestProduct == null) {
            // Kode pertama
            $nomorUrut = 1;
        } else {
            // Kode berikutnya
            $lastCode = substr($latestProduct->kode_barang, 7);
            $nomorUrut = intval($lastCode) + 1;
        }
        // Menggabungkan semua komponen kode barang
        $kode_barang = 'BRG' . $currentYear . str_pad($nomorUrut, STR_PAD_LEFT);
        // Validasi input
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
        ]);
        try {
            // Menyiapkan data untuk disimpan
            $validatedData = $request->except('_token');
            $validatedData['kode_barang'] = $kode_barang;
            // Menyimpan data ke dalam database
            \App\Models\Product::create($validatedData);
            return redirect()->back()->with('success', 'Data barang berhasil ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data barang gagal ditambah.');
        }
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_barang' => 'required',
    //         'stok' => 'required',
    //         'harga' => 'required',
    //         'deskripsi' => 'required',
    //     ]);
    //     // dd($request);
    //     try {
    //         $validatedData = $request->except('_token');
    //         // dd($validatedData);
    //         product::create($validatedData);
    //         return redirect()->back()->with('success', 'Data barang berhasil ditambah.');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Data barang gagal ditambah.');
    //     }
    //     return redirect()->back()->with('success', 'Data barang berhasil ditambah.');
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd('oke');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // dd('oke');
    }

    public function update(Request $request, $id)
    {
        // dd('oke');
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return redirect()->back()->with('success', 'Data barang berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data barang gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('success', 'Data barang berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data barang gagal dihapus');
        }
    }
}
