<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\m_role;
use App\Models\m_warehouse;
use Illuminate\Http\Request;

class M_userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('oke');
        $user = User::get();
        return view('addons.SettingPlatform.manajement_user', compact('user'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd('oke');
        $user = User::find($id);
        $role = m_role::get();
        $warehouse = m_warehouse::get();
        return view('addons.SettingPlatform.update_user', compact('user', 'role', 'warehouse'));
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
        $request->validate([
            'fullname' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'divisi' => 'required',
            'address' => 'required',
            'status' => 'required',
            'role_id' => 'required',
            'warehouse_id' => 'required',
        ]);
        // dd($request->all());
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return redirect()->route('user.index')->with('success', 'Data User berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data User gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success', 'Data user berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data user gagal dihapus');
        }
    }
}
