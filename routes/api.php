<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananKesehatanController;

/*
|--------------------------------------------------------------------------
| API Routes - Kelompok Binary
|--------------------------------------------------------------------------
*/

// Rute Publik (Tidak Butuh Login)
Route::post('/register', [LayananKesehatanController::class, 'register']);
Route::post('/login', [LayananKesehatanController::class, 'login']);

// Rute Terproteksi (Wajib Login / Menggunakan Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Fitur 1: Manajemen Pengguna / Ambil Data Profil
    Route::get('/user-profile', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    });
    Route::post('/logout', [LayananKesehatanController::class, 'logout']);

    // Fitur 2: Pencarian Faskes (Mengambil Data dari Third-Party API)
    Route::get('/faskes', [LayananKesehatanController::class, 'getFaskes']);

    // Fitur 3: Reservasi Janji Temu Dokter (Booking System)
    Route::get('/jadwal-dokter', [LayananKesehatanController::class, 'getJadwal']);
    Route::post('/booking-jadwal', [LayananKesehatanController::class, 'createBooking']);

    // Fitur 4: Pencatatan Rekam Medis Digital
    Route::get('/rekam-medis', [LayananKesehatanController::class, 'getRekamMedis']);
    Route::post('/rekam-medis/tambah', [LayananKesehatanController::class, 'storeRekamMedis']);
    Route::get('/rekam-medis/delete/{id}', [LayananKesehatanController::class, 'deleteRekamMedis']); // <--- TAMBAHKAN BARIS INI

    // Fitur Tambahan (Bonus Nilai): Manajemen Resep Obat
    Route::get('/resep-obat', [LayananKesehatanController::class, 'getResepObat']);
    Route::post('/resep-obat/tambah', [LayananKesehatanController::class, 'storeResepObat']);
});