<?php

namespace App\Http\Controllers\API\v1\AuthApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class EditApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Mendapatkan pengguna yang terotentikasi dari token JWT
        $user = JWTAuth::parseToken()->authenticate();

        // Validasi input
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                // Tambahkan validasi untuk bidang lain jika diperlukan
            ],
            [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
            ]
        );

        // Memperbarui data pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Tambahkan perubahan lain sesuai kebutuhan

        // Menyimpan perubahan ke database
        $user->save();

        // Memberikan respon
        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil diperbarui',
            'user'    => auth()->guard('api')->user(),
        ], 200);
    }
}
