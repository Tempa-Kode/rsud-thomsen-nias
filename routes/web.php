<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'prosesLogin'])->name('login.proses');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'pendaftaranAkun'])->name('register');
Route::get('/dashboard', [\App\Http\Controllers\AuthController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::prefix('/pengguna')->middleware(['auth'])->group(function () {
    Route::resource('superadmin', \App\Http\Controllers\SuperAdminController::class)->names('superadmin');
    Route::resource('pimpinan', \App\Http\Controllers\PimpinanController::class)->names('pimpinan');
});
