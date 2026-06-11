<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RekamMedisController;
use App\Http\Controllers\API\JadwalDokterController;
use App\Http\Controllers\API\FaskesController; // <-- Tambah ini

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- FITUR REKAM MEDIS ---
Route::get('/rekam-medis', [RekamMedisController::class, 'index']);
Route::post('/rekam-medis', [RekamMedisController::class, 'store']);

// --- FITUR BOOKING JADWAL DOKTER ---
Route::get('/jadwal-dokter', [JadwalDokterController::class, 'index']);
Route::post('/jadwal-dokter', [JadwalDokterController::class, 'store']);

// --- FITUR PENCARIAN FASKES TERDEKAT ---
Route::get('/faskes', [FaskesController::class, 'index']);
Route::post('/faskes', [FaskesController::class, 'store']);