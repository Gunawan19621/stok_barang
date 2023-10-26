<?php

namespace App\Http\Controllers;

use App\Models\asset_status;
use App\Models\m_asset;
use App\Models\m_warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = [
            'peminjaman' => asset_status::get(),
            'active' => 'menu-pengembalian',
        ];
        return view('dashboard.Pengembalian.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'peminjaman' => asset_status::findOrFail($id),
            'warehouse' => m_warehouse::get(),
            'active' => 'menu-pengembalian',
        ];
        return view('dashboard.Pengembalian.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'asset_id' => 'required',
            'exit_at' => 'required',
            'exit_pic' => 'required',
            'enter_at' => 'required',
            'enter_pic' => 'required',
            'enter_warehouse' => 'required',
        ]);

        try {
            $peminjaman = asset_status::findOrFail($id);
            $peminjaman['updated_by'] = Auth::user()->fullname; // Menambahkan ID pengguna sebagai updated_by
            $peminjaman->update($request->all());

            return redirect()->route('dashboard.pengembalian.index')->with('success', 'Data peminjaman berhasil diperbaharui');
        } catch (\Throwable $th) {
            // Tampilkan pesan kesalahan untuk debugging
            return redirect()->back()->with('error', 'Data peminjaman gagal diperbaharui: ' . $th->getMessage());
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'asset_id' => 'required',
    //         'exit_at' => 'required',
    //         'exit_pic' => 'required',
    //         'enter_at' => 'required',
    //         'enter_pic' => 'required',
    //         'enter_warehouse' => 'required',
    //     ]);
    //     try {
    //         $peminjaman = asset_status::findOrFail($id);
    //         $peminjaman['updated_by'] = Auth::user()->fullname; // Menambahkan ID pengguna sebagai updated_by
    //         $peminjaman->update($request->all());
    //         return redirect()->route('pengembalian.index')->with('success', 'Data peminjaman berhasil diperbaharui');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Data peminjaman gagal diperbaharui');
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
    }
}
