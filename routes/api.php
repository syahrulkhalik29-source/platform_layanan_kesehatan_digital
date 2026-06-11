<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RekamMedisController;
use App\Http\Controllers\API\JadwalDokterController;
use App\Http\Controllers\API\FaskesController;
use App\Http\Controllers\API\ResepObatController; // <-- Tambah ini untuk E-Resep

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- FITUR 1: REKAM MEDIS ---
Route::get('/rekam-medis', [RekamMedisController::class, 'index']);
Route::post('/rekam-medis', [RekamMedisController::class, 'store']);

// --- FITUR 2: BOOKING JADWAL DOKTER ---
Route::get('/jadwal-dokter', [JadwalDokterController::class, 'index']);
Route::post('/jadwal-dokter', [JadwalDokterController::class, 'store']);

// --- FITUR 3: PENCARIAN FASKES TERDEKAT ---
Route::get('/faskes', [FaskesController::class, 'index']);
Route::post('/faskes', [FaskesController::class, 'store']);

// --- FITUR 4: E-RESEP & DETAIL OBAT ---
Route::get('/resep-obat', [ResepObatController::class, 'index']);
Route::post('/resep-obat', [ResepObatController::class, 'store']);