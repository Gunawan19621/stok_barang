<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PengadaanController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard2', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update', [ProfileController::class, 'updateprofile'])->name('update.updateprofile');
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
    Route::middleware('auth')->resource('/settingPlatform', SettingPlatformController::class);
});

require __DIR__ . '/auth.php';
