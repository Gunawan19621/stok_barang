<?php

namespace App\Http\Controllers;

use App\Models\asset_status;
use App\Models\m_asset;
use App\Models\m_warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset = m_asset::all();
        $peminjaman = asset_status::get();
        $warehouse = m_warehouse::get();
        return view('dashboard.peminjaman', compact('asset', 'peminjaman', 'warehouse'));
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
        // dd('oke');
        $request->validate([
            'asset_id' => 'required',
            'exit_at' => 'required',
            'exit_pic' => 'required',
            'exit_warehouse' => 'required',
        ]);
        // dd($request);
        try {
            $currentUser = Auth::user();

            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai updated_by
            // dd($validatedData);
            asset_status::create($validatedData);
            return redirect()->back()->with('success', 'Data peminjaman berhasil ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data peminjaman gagal ditambah.');
        }
        return redirect()->back()->with('success', 'Data peminjaman berhasil ditambah.');
    }

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd('oke');
        $request->validate([
            'asset_id' => 'required',
            'exit_at' => 'required',
            'exit_pic' => 'required',
            'exit_warehouse' => 'required',
        ]);
        // dd($request);
        try {
            $peminjaman = asset_status::findOrFail($id);
            $peminjaman['updated_by'] = Auth::user()->fullname; // Menambahkan ID pengguna sebagai updated_by
            $peminjaman->update($request->all());
            return redirect()->back()->with('success', 'Data peminjaman berhasil diperbaharui');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Data peminjaman gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $peminjaman = asset_status::findOrFail($id);
            $peminjaman->delete();
            return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data peminjaman gagal dihapus');
        }
    }
}
