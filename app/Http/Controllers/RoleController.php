<?php

namespace App\Http\Controllers;

use App\Models\m_role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = m_role::all();
        return view('MasterData.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('MasterData.role.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        try {
            $validatedData = $request->except('_token');
            m_role::create($validatedData);
            return redirect()->back()->with('success', 'Data role Berhasil Ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data role Gagal Ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     // dd('oke');
    //     return view('MasterData.role.show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd('oke');
        $role = m_role::find($id);
        return view('MasterData.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        dd('oke');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $role = m_role::findOrFail($id);
            $role->delete();
            return redirect()->back()->with('success', 'Data role berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data role gagal dihapus');
        }
    }
}