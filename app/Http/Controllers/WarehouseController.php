<?php

namespace App\Http\Controllers;

use App\Models\m_warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = m_warehouse::all();
        return view('MasterData.warehouse', compact('warehouses'));
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
        // dd($request);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);
        try {
            $validatedData = $request->except('_token');
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
