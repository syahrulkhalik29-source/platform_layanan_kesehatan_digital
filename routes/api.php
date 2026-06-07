<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\API\RekamMedisController;

Route::get('/rekam-medis', [RekamMedisController::class, 'index']);
Route::post('/rekam-medis', [RekamMedisController::class, 'store']);
