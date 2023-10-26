<?php

namespace App\Http\Controllers\API\v1\AuthApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;

class LoginApiController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data profile user berhasil diambil');
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            // set validation
            $validator = Validator::make($request->all(), [
                'email'     => 'required',
                'password'  => 'required'
            ]);

            // if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // get credentials from request
            $credentials = $request->only('email', 'password');

            // if auth failed
            if (!$token = auth()->guard('api')->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau Password Anda salah'
                ], 401);
            }

            // if auth success
            $user = auth()->guard('api')->user();

            // Load roles for the user
            // $user->load('roles');

            return ResponseFormatter::success([
                'token_type' => 'Bearer',
                'user'    => $user,
                'token'   => $token
                // 'roles'   => $user->roles
            ], 'Authentication successful');
        } catch (\Exception $e) {
            return ResponseFormatter::error([
                'message' => 'Terjadi kesalahan saat memproses permintaan',
                'error'   => $e->getMessage()
            ], 'Authentication failed', 500);
        }
    }
}
