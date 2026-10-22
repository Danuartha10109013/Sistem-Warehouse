<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PackingList2ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile REST API Routes (Flutter)
|--------------------------------------------------------------------------
| Seluruh rute API di bawah ini terisolasi penuh dari rute web browser.
| Mendukung autentikasi Bearer Token Laravel Sanctum.
*/

// Auth Endpoint (Public)
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Protected Endpoints (Wajib Bearer Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Sesi Profil & Modul Dinamis
    Route::get('/me', [AuthController::class, 'me'])->name('api.me');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // ==========================================
    // MODUL: PACKING LIST 2.0 (Mobile Validation)
    // ==========================================
    Route::prefix('packing-list-2')->group(function () {
        Route::get('/summary', [PackingList2ApiController::class, 'getSummary'])->name('api.pl2.summary');
        Route::get('/batches', [PackingList2ApiController::class, 'getBatches'])->name('api.pl2.batches');
        Route::get('/batches/{id}/items', [PackingList2ApiController::class, 'getBatchItems'])->name('api.pl2.batch.items');
        Route::get('/scan', [PackingList2ApiController::class, 'scanCoil'])->name('api.pl2.scan');
        Route::post('/validate/{id}', [PackingList2ApiController::class, 'validateItem'])->name('api.pl2.validate');
        Route::post('/validate-bulk', [PackingList2ApiController::class, 'validateBulk'])->name('api.pl2.validate-bulk');
    });
});
