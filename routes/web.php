<?php

use App\Models\m_asset;
use App\Models\asset_status;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\M_userController;
use App\Http\Controllers\M_assetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\SettingPlatformController;

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


Route::redirect('/', '/login');

Route::get('/redirect', [\App\Http\Controllers\Auth\RedirectAuthController::class, 'redirectAuth'])->name('redirect')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/{id}', [ProfileController::class, 'updateprofile'])->name('profile.updateprofile');
    // Route::post('/profile-update', [ProfileController::class, 'updatePhoto'])->name('profile-update');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('profile.setting');
});


Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.admin');

    //Halaman Warehouse
    Route::controller(WarehouseController::class)->group(function () {
        Route::get('warehouse', 'index')->name('warehouse.index');
        Route::post('warehouse/store', 'store')->name('warehouse.store');
        Route::put('warehouse/{id}', 'update')->name('warehouse.update');
        Route::delete('warehouse/delete/{id}', 'destroy')->name('warehouse.destroy');
    });

    //Halaman Role
    Route::controller(RoleController::class)->group(function () {
        Route::get('role', 'index')->name('role.index');
        Route::post('role/store', 'store')->name('role.store');
        Route::put('role/{id}', 'update')->name('role.update');
        Route::delete('role/delete/{id}', 'destroy')->name('role.destroy');
    });

    //Halaman Asset
    Route::controller(M_assetController::class)->group(function () {
        Route::get('asset', 'index')->name('asset.index');
        Route::post('asset/store', 'store')->name('asset.store');
        Route::get('asset/{id}', 'show')->name('asset.show');
        Route::put('asset/{id}', 'update')->name('asset.update');
        Route::delete('asset/delete/{id}', 'destroy')->name('asset.destroy');
        Route::get('/assetcetak_pdf', [M_assetController::class, 'cetakpdf'])->name('assetcetakpdf.cetakpdf');
        Route::get('/assetexport', [M_assetController::class, 'export'])->name('assetexport.export');
    });

    //Halaman User
    Route::controller(M_userController::class)->group(function () {
        Route::get('user', 'index')->name('user.index');
        Route::get('user/create', 'create')->name('user.create');
        Route::post('user/store', 'store')->name('user.store');
        Route::get('user/{id}', 'show')->name('user.show');
        Route::get('user/{id}/edit', 'edit')->name('user.edit');
        Route::put('user/{id}', 'update')->name('user.update');
        Route::delete('user/delete/{id}', 'destroy')->name('user.destroy');
    });

    //Halaman Peminjaman
    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('peminjaman', 'index')->name('peminjaman.index');
        Route::get('peminjaman/create', 'create')->name('peminjaman.create');
        Route::post('peminjaman/store', 'store')->name('peminjaman.store');
        Route::get('peminjaman/{id}/edit', 'edit')->name('peminjaman.edit');
        Route::put('peminjaman/{id}', 'update')->name('peminjaman.update');
        Route::delete('peminjaman/delete/{id}', 'destroy')->name('peminjaman.destroy');
    });

    //Halaman Pengembalian
    Route::controller(PengembalianController::class)->group(function () {
        Route::get('pengembalian', 'index')->name('pengembalian.index');
        Route::get('pengembalian/create', 'create')->name('pengembalian.create');
        Route::post('pengembalian/store', 'store')->name('pengembalian.store');
        Route::get('pengembalian/{id}', 'show')->name('pengembalian.show');
        Route::get('pengembalian/{id}/edit', 'edit')->name('pengembalian.edit');
        Route::put('pengembalian/{id}', 'update')->name('pengembalian.update');
        Route::delete('pengembalian/delete/{id}', 'destroy')->name('pengembalian.destroy');
    });
});


require __DIR__ . '/auth.php';
