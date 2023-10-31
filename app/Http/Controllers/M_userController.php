<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\m_role;
use App\Models\m_warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidasiCreateUser;

class M_userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'warehouse' => m_warehouse::get(),
            'role' => m_role::get(),
            'user' => User::get(),
            'active' => 'menu-user',
        ];
        return view('dashboard.Master_Data.User.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'warehouse' => m_warehouse::get(),
            'role' => m_role::get(),
            'active' => 'menu-user',
        ];
        return view('dashboard.Master_Data.User.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidasiCreateUser $request)
    {

        try {
            $currentUser = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai updated_by
            $validatedData['password'] = bcrypt($request->input('password')); // Enkripsi password
            user::create($validatedData);
            return redirect()->route('dashboard.user.index')->with('success', 'Data User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data User Gagal Ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = [
            'warehouse' => m_warehouse::get(),
            'role' => m_role::get(),
            'user' => User::find($id),
            'active' => 'menu-user',
        ];
        return view('dashboard.Master_Data.User.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'warehouse' => m_warehouse::get(),
            'role' => m_role::get(),
            'user' => User::find($id),
            'active' => 'menu-user',
        ];
        return view('dashboard.Master_Data.User.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
        // dd($request->all());
        try {
            $user = User::findOrFail($id);
            $userData = $request->all();

            // Menambahkan nama pengguna yang melakukan pembaruan
            $userData['updated_by'] = Auth::user()->fullname;

            $user->update($userData);
            return redirect()->route('dashboard.user.index')->with('success', 'Data User berhasil diperbaharui');
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
