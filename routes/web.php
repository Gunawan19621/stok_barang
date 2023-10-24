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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/{id}', [ProfileController::class, 'updateprofile'])->name('profile.updateprofile');
    Route::post('/profile-update', [ProfileController::class, 'updatePhoto'])->name('profile-update');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('profile.setting');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    //Halaman dashboard
    Route::middleware('auth')->get('', function () {
        $reminder = asset_status::whereNull('enter_at')->count();
        $jumlahAsset = m_asset::count();
        $jumlahPeminjaman = asset_status::count();
        $jumlahPengembalian = asset_status::whereNotNull('enter_at')->count();
        return view('dashboard.index', compact('jumlahAsset', 'jumlahPeminjaman', 'jumlahPengembalian', 'reminder'));
    });

    //Halaman Role
    Route::controller(RoleController::class)->group(function () {
        Route::get('role', 'index')->name('role.index');
        Route::post('role/store', 'store')->name('role.store');
        Route::put('role/{id}', 'update')->name('role.update');
        Route::get('role/delete/{id}', 'destroy')->name('role.destroy');
    });


    //Halaman Peminjaman
    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('peminjaman', 'index')->name('peminjaman.index');
        Route::post('peminjaman/store', 'store')->name('peminjaman.store');
        Route::put('peminjaman/{id}', 'update')->name('peminjaman.update');
        Route::delete('peminjaman/delete/{id}', 'destroy')->name('peminjaman.destroy');
    });
});

Route::group(['prefix' => 'dashboard'], function () {
    //Halaman Pengembalian
    Route::middleware('auth')->resource('/pengembalian', PengembalianController::class);

    //Halaman Pengadaan
    Route::middleware('auth')->resource('/pengadaan', PengadaanController::class);

    //Halaman Manajemen Asset
    Route::middleware('auth')->resource('/asset', M_assetController::class);
    Route::get('/hapusAsset/{id}', [M_assetController::class, 'destroy'])->name('hapusAsset.destroy');
    Route::get('/assetcetak_pdf', [M_assetController::class, 'cetakpdf'])->name('assetcetakpdf.cetakpdf');
    Route::get('/assetexport', [M_assetController::class, 'export'])->name('assetexport.export');

    //Halaman Manajemen User
    Route::middleware('auth')->resource('/user', M_userController::class);
    Route::get('/hapusUser/{id}', [M_userController::class, 'destroy'])->name('hapusUser.destroy');

    //Halaman Warehouse
    Route::middleware('auth')->resource('/warehouse', WarehouseController::class);
    Route::get('/hapuswarehouse/{id}', [WarehouseController::class, 'destroy'])->name('hapuswarehouse.destroy');
});

require __DIR__ . '/auth.php';
