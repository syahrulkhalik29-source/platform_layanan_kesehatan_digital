<?php

use Illuminate\Support\Facades\Route;

// Di dalam arsitektur API terpisah, web.php hanya merespon landing page status jika diakses
Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'service' => 'Platform Layanan Kesehatan - API Core Core Running Perfectly',
        'environment' => 'Render Cloud Environment Ready'
    ]);
});