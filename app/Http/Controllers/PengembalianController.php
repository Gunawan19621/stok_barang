<?php

namespace App\Http\Controllers;

use App\Models\Peti;
use App\Models\m_asset;
use App\Models\m_warehouse;
use App\Models\asset_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = [
            'peminjaman' => asset_status::all(),
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
            'peti' => Peti::get(),
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
            'peti_id' => 'required',
            'exit_at' => 'required',
            'est_pengembalian' => 'required',
            'exit_warehouse' => 'required',
            'enter_at' => 'required',
            'enter_warehouse' => 'required',
            'kondisi_peti' => 'required',
        ]);

        try {
            $peminjaman = asset_status::findOrFail($id);

            // Update atribut-atribut yang diperlukan
            $peminjaman->enter_pic = Auth::user()->id;
            $peminjaman->updated_by = Auth::user()->id;

            $peminjaman->peti_id = $request->input('peti_id');
            $peminjaman->exit_at = $request->input('exit_at');
            $peminjaman->est_pengembalian = $request->input('est_pengembalian');
            $peminjaman->exit_warehouse = $request->input('exit_warehouse');
            $peminjaman->enter_at = $request->input('enter_at');
            $peminjaman->enter_warehouse = $request->input('enter_warehouse');
            $peminjaman->kondisi_peti = $request->input('kondisi_peti');

            // dd($peminjaman);
            $peminjaman->save();

            return redirect()->route('dashboard.pengembalian.index')->with('success', 'Data peminjaman berhasil diperbaharui');
        } catch (\Throwable $th) {
            // Tampilkan pesan kesalahan untuk debugging
            return redirect()->back()->with('error', 'Data peminjaman gagal diperbaharui: ' . $th->getMessage());
        }
    }

    // public function update(Request $request, $id)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'peti_id' => 'required',
    //         'exit_at' => 'required',
    //         'est_pengembalian' => 'required',
    //         'exit_warehouse' => 'required',
    //         'enter_at' => 'required',
    //         'enter_warehouse' => 'required',
    //         'kondisi_peti' => 'required',
    //     ]);
    //     // dd($request);

    //     try {
    //         $peminjaman = asset_status::findOrFail($id);
    //         $peminjaman['enter_pic'] = Auth::user()->id; // Menambahkan ID pengguna sebagai updated_by
    //         $peminjaman['updated_by'] = Auth::user()->id; // Menambahkan ID pengguna sebagai updated_by
    //         dd($peminjaman);
    //         $peminjaman->update($request->all());

    //         return redirect()->route('dashboard.pengembalian.index')->with('success', 'Data peminjaman berhasil diperbaharui');
    //     } catch (\Throwable $th) {
    //         // Tampilkan pesan kesalahan untuk debugging
    //         return redirect()->back()->with('error', 'Data peminjaman gagal diperbaharui: ' . $th->getMessage());
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
