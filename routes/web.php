<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'pendaftaranAkun'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'prosesDaftar'])->name('proses.register');
Route::get('/dashboard', [\App\Http\Controllers\AuthController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::prefix('/pengguna')->middleware(['auth'])->group(function () {
    Route::resource('superadmin', \App\Http\Controllers\SuperadminController::class)->names('superadmin');
    Route::resource('pimpinan', \App\Http\Controllers\PimpinanController::class)->names('pimpinan');
    Route::resource('dokter', \App\Http\Controllers\DokterController::class)->names('dokter');
    Route::resource('kasir', \App\Http\Controllers\KasirController::class)->names('kasir');
    Route::resource('pasien', \App\Http\Controllers\PasienController::class)->names('pasien');
});
Route::resource('poli', \App\Http\Controllers\PoliController::class)->middleware(['auth'])->names('poli');
Route::resource('obat', \App\Http\Controllers\ObatController::class)->middleware(['auth'])->names('obat');
Route::get('obat-report/download', [\App\Http\Controllers\ObatController::class, 'downloadPDF'])->middleware(['auth'])->name('obat.report.download');

Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update-data-pasien', [\App\Http\Controllers\ProfileController::class, 'updateDataPasien'])->name('profile.updateDataPasien');
    Route::post('/update-data-pimpinan', [\App\Http\Controllers\ProfileController::class, 'updateDataPimpinan'])->name('profile.updateDataPimpinan');
    Route::post('/update-data-kasir', [\App\Http\Controllers\ProfileController::class, 'updateDataKasir'])->name('profile.updateDataKasir');
    Route::post('/update-data-dokter', [\App\Http\Controllers\ProfileController::class, 'updateDataDokter'])->name('profile.updateDataDokter');
});

Route::prefix('rawat-jalan')->middleware(['auth', 'profilePasien'])->group(function () {
    Route::get('/', [\App\Http\Controllers\RawatJalanController::class, 'index'])->name('rawat-jalan.index');
    Route::get('/pilih-pendaftaran', [\App\Http\Controllers\RawatJalanController::class, 'pilihPendaftaran'])->name('rawat-jalan.pilih-pendaftaran');
    Route::get('/halaman-pendaftaran', [\App\Http\Controllers\RawatJalanController::class, 'halamanPendaftaran'])->name('rawat-jalan.halaman-pendaftaran');
    Route::post('/daftar', [\App\Http\Controllers\RawatJalanController::class, 'daftar'])->name('rawat-jalan.daftar');
});

Route::prefix('riwayat-pemeriksaan')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'index'])->name('riwayat-pemeriksaan.index');
    Route::get('/periksa/{id}', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'periksa'])->name('riwayat-pemeriksaan.periksa');
    Route::post('/periksa/{id}', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'simpanPemeriksaan'])->name('riwayat-pemeriksaan.simpanPeriksa');
    Route::get('/{id}/edit', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'edit'])->name('riwayat-pemeriksaan.edit');
    Route::put('/{id}', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'update'])->name('riwayat-pemeriksaan.update');
    Route::get('/{id}', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'show'])->name('riwayat-pemeriksaan.show');
});

Route::prefix('resep-obat')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\ResepObatController::class, 'index'])->name('resep-obat.index');
    Route::get('/{id}', [\App\Http\Controllers\ResepObatController::class, 'show'])->name('resep-obat.show');
});

Route::prefix('pembayaran')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::put('/bayar/{id}', [\App\Http\Controllers\PembayaranController::class, 'bayar'])->name('pembayaran.bayar');
    Route::get('/struk/{id}', [\App\Http\Controllers\PembayaranController::class, 'strukPembayaran'])->name('pembayaran.struk');
});

Route::get('/rekam-medik/{pasienId}', [\App\Http\Controllers\RiwayatPemeriksaanController::class, 'cetakRekamMedik'])->middleware(['auth'])->name('rekam-medik.cetak');

Route::prefix('download')->middleware(['auth'])->group(function () {
    Route::get('pasien-pdf', [\App\Http\Controllers\PasienController::class, 'downloadPDF'])->name('download.pasien.pdf');
});
