<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingPlatformController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/{id}', [ProfileController::class, 'updateprofile'])->name('profile.updateprofile');
    // Route::put('/profile/{id}', 'ProfileController@updateprofile')->name('profile.update');
    Route::post('/profile-update', [ProfileController::class, 'updatePhoto'])->name('profile-update');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('profile.setting');
});

Route::group(['prefix' => 'dashboard'], function () {
    //Halaman dashboard
    Route::middleware('auth')->get('', function () {
        return view('dashboard.index');
    });

    //Halaman Transaksi
    Route::middleware('auth')->resource('/transaksi', TransaksiController::class);

    //Halaman Peminjaman
    Route::middleware('auth')->resource('/peminjaman', PeminjamanController::class);

    //Halaman Pengembalian
    Route::middleware('auth')->resource('/pengembalian', PengembalianController::class);

    //Halaman Pengadaan
    Route::middleware('auth')->resource('/pengadaan', PengadaanController::class);

    //Halaman Setting Platform
    Route::middleware('auth')->resource('/product', ProductController::class);
    Route::get('/hapusProduct/{id}', [ProductController::class, 'destroy'])->name('hapusProduct.destroy');
});

require __DIR__ . '/auth.php';
