<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-rumah-sakit', function (Request $request) {
    $url = env('SATUSEHAT_API_URL') . '/mastersaranaindex/mastersarana';
    $token = env('SATUSEHAT_BEARER_TOKEN');

    $response = Http::withToken($token)->get($url, [
        'limit' => 2000,
        'page' => 1,
        'jenis_sarana' => 104,
        'kode_provinsi' => 12,
    ]);

    if ($response->successful()) {
        return $response->json(); // Kembalikan data JSON ke client
    }

    // Handle error
    return response()->json(['error' => 'Tidak dapat mengambil data'], $response->status());
});
