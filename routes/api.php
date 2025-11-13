<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-rumah-sakit', function (Request $request) {
    // Step 1: Get access token from OAuth2 endpoint
    $tokenUrl = 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken';
    $clientId = env('SATUSEHAT_CLIENT_ID', 'PPNsHrJ4uegGwrSgR8Swm5zvirEupkMuFpGiMAShb1DSdxDu');
    $clientSecret = env('SATUSEHAT_CLIENT_SECRET', 'FtTE6yZXuznTh16XNRDSnlWKegqHwTTFzqzF9awkVSDQ6np2ngGubf0tulRj8evj');

    // Format sesuai dengan Postman: x-www-form-urlencoded dengan query parameter
    $tokenResponse = Http::asForm()->post($tokenUrl . '?grant_type=client_credentials', [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
    ]);

    if (!$tokenResponse->successful()) {
        return response()->json([
            'error' => 'Gagal mendapatkan access token',
            'status' => $tokenResponse->status(),
            'message' => $tokenResponse->body()
        ], $tokenResponse->status());
    }

    $tokenData = $tokenResponse->json();
    $accessToken = $tokenData['access_token'] ?? null;

    if (!$accessToken) {
        return response()->json([
            'error' => 'Access token tidak ditemukan dalam response',
            'response' => $tokenData
        ], 500);
    }

    // Step 2: Get rumah sakit data using the access token
    $url = env('SATUSEHAT_API_URL', 'https://api-satusehat-stg.dto.kemkes.go.id') . '/mastersaranaindex/mastersarana';

    $response = Http::withToken($accessToken)->get($url, [
        'limit' => 2000,
        'page' => 1,
        'jenis_sarana' => 104,
        'kode_provinsi' => 12,
    ]);

    if ($response->successful()) {
        return $response->json(); // Kembalikan data JSON ke client
    }

    // Handle error
    return response()->json([
        'error' => 'Tidak dapat mengambil data rumah sakit',
        'status' => $response->status(),
        'message' => $response->body()
    ], $response->status());
});
