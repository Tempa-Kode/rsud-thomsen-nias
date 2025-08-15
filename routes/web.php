<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'pendaftaranAkun'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'prosesDaftar'])->name('proses.register');
Route::get('/dashboard', [\App\Http\Controllers\AuthController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::prefix('/pengguna')->middleware(['auth'])->group(function () {
    Route::resource('superadmin', \App\Http\Controllers\SuperAdminController::class)->names('superadmin');
    Route::resource('pimpinan', \App\Http\Controllers\PimpinanController::class)->names('pimpinan');
    Route::resource('dokter', \App\Http\Controllers\DokterController::class)->names('dokter');
    Route::resource('kasir', \App\Http\Controllers\KasirController::class)->names('kasir');
    Route::resource('pasien', \App\Http\Controllers\PasienController::class)->names('pasien');
});
Route::resource('poli', \App\Http\Controllers\PoliController::class)->middleware(['auth'])->names('poli');
Route::resource('obat', \App\Http\Controllers\ObatController::class)->middleware(['auth'])->names('obat');

Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update-data-pasien', [\App\Http\Controllers\ProfileController::class, 'updateDataPasien'])->name('profile.updateDataPasien');
    Route::post('/update-data-pimpinan', [\App\Http\Controllers\ProfileController::class, 'updateDataPimpinan'])->name('profile.updateDataPimpinan');
    Route::post('/update-data-kasir', [\App\Http\Controllers\ProfileController::class, 'updateDataKasir'])->name('profile.updateDataKasir');
    Route::post('/update-data-dokter', [\App\Http\Controllers\ProfileController::class, 'updateDataDokter'])->name('profile.updateDataDokter');
});

Route::prefix('rawat-jalan')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\RawatJalanController::class, 'index'])->name('rawat-jalan.index');
});
