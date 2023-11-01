<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidasiCreateType_Peti;
use App\Http\Requests\ValidasiUpdateType_Peti;
use App\Models\Type_peti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypePetiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'typepeti' => Type_peti::all(),
            'active' => 'menu-typepeti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Type_peti.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'menu-typepeti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Type_peti.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidasiCreateType_Peti $request)
    {
        try {
            $currenttype = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currenttype->fullname; // Menggunakan nama pengguna sebagai created_by
            $validatedData['updated_by'] = $currenttype->fullname; // Menggunakan nama pengguna sebagai updated_by
            // dd($validatedData);
            Type_peti::create($validatedData);
            return redirect()->route('dashboard.typepeti.index')->with('success', 'Data Tipe Peti berhasil ditambahkan');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('error', 'Data Tipe Peti Gagal Ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = [
            'typepeti' => Type_peti::findOrFail($id), // Mengambil detail data yang sesuai dengan parameter $id
            'active' => 'menu-typepeti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Type_peti.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'typepeti' => Type_peti::findOrFail($id),
            'active' => 'menu-typepeti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Type_peti.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidasiUpdateType_Peti $request, $id)
    {
        try {
            $typepeti = Type_peti::findOrFail($id);
            $typepetiData = $request->all();

            // Menambahkan nama pengguna yang melakukan pembaruan
            $typepetiData['updated_by'] = Auth::user()->fullname;

            $typepeti->update($typepetiData);
            return redirect()->route('dashboard.typepeti.index')->with('success', 'Data typepeti berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data typepeti gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $typepeti = Type_peti::findOrFail($id);
            $typepeti->delete();
            return redirect()->back()->with('success', 'Data tipe peti berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tipe peti gagal dihapus');
        }
    }
}
