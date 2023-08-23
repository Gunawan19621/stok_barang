<?php

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/forgot_password', function () {
    return view('forgot_password');
});

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/home', function () {
    return view('layouts.main');
});


Route::get('/transaksi', function () {
    return view('dashboard.transaksi');
});

Route::get('/peminjaman', function () {
    return view('dashboard.peminjaman');
});

Route::get('/pengembalian', function () {
    return view('dashboard.pengembalian');
});

Route::get('/pengadaan', function () {
    return view('addons.pengadaan');
});

Route::get('/pengadaan', function () {
    return view('addons.pengadaan');
});

Route::get('/settingPlatform', function () {
    return view('addons.settingPlatform');
});

Route::get('/profil', function () {
    return view('profil.profil');
});
