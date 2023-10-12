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
        // dd('oke');
        $peminjaman = asset_status::get();
        return view('dashboard.pengembalian', compact('peminjaman'));
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
        $warehouse = m_warehouse::get();
        $peminjaman = asset_status::findOrFail($id);
        return view('dashboard.update_pengembalian', compact('peminjaman', 'warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // dd('oke');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd('oke');
        // dd($request->all());
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
            return redirect()->route('pengembalian.index')->with('success', 'Data peminjaman berhasil diperbaharui');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Data peminjaman gagal diperbaharui');
        }
    }
    // public function update(Request $request, $id)
    // {
    //     // dd('oke');
    //     $request->validate([
    //         'asset_id' => 'required',
    //         'exit_at' => 'required',
    //         'exit_pic' => 'required',
    //         'exit_warehouse' => 'required',
    //         'enter_at' => 'required',
    //         'enter_pic' => 'required',
    //         'enter_warehouse' => 'required',
    //     ]);
    //     // dd($request);
    //     try {
    //         $peminjaman = asset_status::findOrFail($id);
    //         // dd($peminjaman);
    //         // dd($request->all());
    //         $peminjaman->update($request->all());
    //         return redirect()->route('pengembalian.index')->with('success', 'Data peminjaman berhasil diperbaharui');
    //     } catch (\Throwable $th) {
    //         // dd($th->getMessage());
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
