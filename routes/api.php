<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::post('/register', App\Http\Controllers\API\v1\AuthApi\RegisterApiController::class)->name('register');
    Route::post('/login', App\Http\Controllers\API\v1\AuthApi\LoginApiController::class)->name('login');
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', App\Http\Controllers\API\v1\AuthApi\LogoutApiController::class)->name('logout');
    Route::put('/user/edit', App\Http\Controllers\API\v1\AuthApi\EditApiController::class)->name('user.edit');


    Route::get('/asset-status', [App\Http\Controllers\API\v1\PeminjamanApi\PeminjamanApiController::class, 'index'])->name('peminjaman-barang');
    Route::post('/asset-status/store', [App\Http\Controllers\API\v1\PeminjamanApi\PeminjamanApiController::class, 'store'])->name('peminjaman-barang.store');
    Route::get('/asset-status/show/{id}', [App\Http\Controllers\API\v1\PeminjamanApi\PeminjamanApiController::class, 'show'])->name('peminjaman-barang.show');

    Route::get('/peti-asset', [App\Http\Controllers\API\v1\AssetStatusApi\AssetStatusApiController::class, 'index'])->name('peti.barang');

    Route::get('/m-warehouse', [App\Http\Controllers\API\v1\WarehouseApi\WarehouseApiController::class, 'index'])->name('warehouse');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
