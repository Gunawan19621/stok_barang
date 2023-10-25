<?php

namespace App\Http\Controllers;

use App\Models\m_warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = m_warehouse::all();
        return view('dashboard.Master_Data.Warehouse.index', compact('warehouses'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashboard.Master_Data.Warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);
        try {
            $currentUser = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai updated_by
            m_warehouse::create($validatedData);
            return redirect()->back()->with('success', 'Data gudang berhasil ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gudang gagal ditambah.');
        }
        return redirect()->back()->with('success', 'Data gudang berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd('oke');
        // return view('dashboard.Master_Data.Warehouse.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // dd('oke');
        // return view('dashboard.Master_Data.Warehouse.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd('oke');
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);
        // dd($request);
        try {
            $warehouse = m_warehouse::findOrFail($id);
            $warehouse->update($request->all());

            // Menambahkan nama pengguna yang melakukan pembaruan
            $userData['updated_by'] = Auth::user()->fullname;

            return redirect()->back()->with('success', 'Data Gudang Berhasil Diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Gudang Gagal Diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $asset = m_warehouse::findOrFail($id);
            $asset->delete();
            return redirect()->back()->with('success', 'Data Gudang berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data Gudang gagal dihapus');
        }
    }
}
