<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\m_role;
use App\Models\m_warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class M_userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('oke');
        $warehouse = m_warehouse::get();
        $role = m_role::get();
        $user = User::get();
        return view('MasterData.user', compact('user', 'role', 'warehouse'));
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
        $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required|email',
            'divisi' => 'required',
            'role_id' => 'required',
            'warehouse_id' => 'required',
            'password' => 'required',
        ]);

        try {
            $currentUser = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai updated_by
            $validatedData['password'] = bcrypt($request->input('password')); // Enkripsi password
            user::create($validatedData);
            return redirect()->back()->with('success', 'Data User Berhasil Ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data User Gagal Ditambah.');
        }
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
        return view('MasterData.update_user', compact('user', 'role', 'warehouse'));
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
            'role_id' => 'required',
            'warehouse_id' => 'required',
        ]);
        // dd($request->all());
        try {
            $user = User::findOrFail($id);
            $userData = $request->all();

            // Menambahkan nama pengguna yang melakukan pembaruan
            $userData['updated_by'] = Auth::user()->fullname;

            $user->update($userData);
            return redirect()->route('user.index')->with('success', 'Data User berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data User gagal diperbaharui');
        }
        // try {
        //     $user = User::findOrFail($id);
        //     $user->update($request->all());

        //     return redirect()->route('user.index')->with('success', 'Data User berhasil diperbaharui');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', 'Data User gagal diperbaharui');
        // }
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
