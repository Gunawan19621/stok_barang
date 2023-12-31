<?php

namespace App\Http\Controllers;

use App\Models\m_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidasiCreateRole;
use App\Http\Requests\ValidasiUpdateRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'role' => m_role::all(),
            'active' => 'menu-role',
        ];
        return view('dashboard.Master_Data.Role.index', $data);
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
    public function store(ValidasiCreateRole $request)
    {
        try {
            $currentUser = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai updated_by
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
    // public function edit($id)
    // {
    //     // dd('oke');
    //     $role = m_role::find($id);
    //     return view('dashboard.Master_Data.Role.edit', compact('role'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidasiUpdateRole $request, $id)
    {
        try {
            $currentUser = Auth::user();
            $role = m_role::findOrFail($id); // Cari peran berdasarkan ID

            $validatedData = $request->except('_token');
            $validatedData['updated_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai updated_by

            $role->update($validatedData); // Update data peran

            return redirect()->back()->with('success', 'Data role Berhasil Diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data role Gagal Diperbarui.');
        }
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
