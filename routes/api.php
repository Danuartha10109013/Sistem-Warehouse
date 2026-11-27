<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BreakBulkApiController;
use App\Http\Controllers\Api\CoilDamageApiController;
use App\Http\Controllers\Api\FormCheckApiController;
use App\Http\Controllers\Api\KendaraanChecklistApiController;
use App\Http\Controllers\Api\MasterProductApiController;
use App\Http\Controllers\Api\LaporanIdOdApiController;
use App\Http\Controllers\Api\LaporanPackingApiController;
use App\Http\Controllers\Api\LaporanRepackingApiController;
use App\Http\Controllers\Api\LaporanSidewallApiController;
use App\Http\Controllers\Api\MobileSyncEventApiController;
use App\Http\Controllers\Api\PackingList2ApiController;
use App\Http\Controllers\Api\ReportOpenPackApiController;
use App\Http\Controllers\Api\ScanKoilEupApiController;
use App\Http\Controllers\Api\StockOpnameApiController;
use App\Http\Controllers\Api\VerifikasiStikerApiController;
use App\Http\Controllers\Api\VerifikasiTimbanganApiController;
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
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('api.profile.update');
    Route::post('/fcm-token', [AuthController::class, 'updateFcmToken'])->name('api.fcm-token');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // ==========================================
    // UNIVERSAL EVENT SOURCING SYNC (OFFLINE FIRST)
    // ==========================================
    Route::post('/sync/events', [MobileSyncEventApiController::class, 'syncBatch'])->name('api.sync.events');

    Route::prefix('report-open-pack')->group(function () {
        Route::get('/coils', [ReportOpenPackApiController::class, 'searchCoils'])->name('api.report-open-pack.coils');
        Route::get('/reports', [ReportOpenPackApiController::class, 'index'])->name('api.report-open-pack.index');
        Route::get('/reports/{id}', [ReportOpenPackApiController::class, 'show'])->name('api.report-open-pack.show');
        Route::post('/sync', [ReportOpenPackApiController::class, 'sync'])->name('api.report-open-pack.sync');
    });

    Route::prefix('checklist-kendaraan')->group(function () {
        Route::get('/list', [KendaraanChecklistApiController::class, 'index'])->name('api.checklist-kendaraan.list');
        Route::get('/{id}', [KendaraanChecklistApiController::class, 'show'])->whereNumber('id')->name('api.checklist-kendaraan.show');
        Route::post('/sync', [KendaraanChecklistApiController::class, 'sync'])->name('api.checklist-kendaraan.sync');
    });

    Route::prefix('master-product')->group(function () {
        Route::get('/list', [MasterProductApiController::class, 'index'])->name('api.master-product.list');
        Route::post('/sync', [MasterProductApiController::class, 'sync'])->name('api.master-product.sync');
    });

    Route::prefix('coil-damage')->group(function () {
        Route::get('/list', [CoilDamageApiController::class, 'index'])->name('api.coil-damage.list');
        Route::post('/sync', [CoilDamageApiController::class, 'sync'])->name('api.coil-damage.sync');
    });

    Route::prefix('laporan-repacking')->group(function () {
        Route::get('/list', [LaporanRepackingApiController::class, 'index'])->name('api.laporan-repacking.list');
        Route::post('/sync', [LaporanRepackingApiController::class, 'sync'])->name('api.laporan-repacking.sync');
    });

    Route::prefix('laporan-packing')->group(function () {
        Route::get('/options', [LaporanPackingApiController::class, 'options'])->name('api.laporan-packing.options');
        Route::get('/list', [LaporanPackingApiController::class, 'list'])->name('api.laporan-packing.list');
        Route::get('/rekap-so/list', [LaporanPackingApiController::class, 'rekapSoList'])->name('api.laporan-packing.rekap-so.list');
        Route::get('/attribute-check', [LaporanPackingApiController::class, 'checkAttribute'])->name('api.laporan-packing.attribute-check');
        Route::get('/rekap-so', [LaporanPackingApiController::class, 'checkRekapSo'])->name('api.laporan-packing.rekap-so');
        Route::post('/sync', [LaporanPackingApiController::class, 'sync'])->name('api.laporan-packing.sync');
    });

    Route::prefix('laporan-sidewall')->group(function () {
        Route::get('/list', [LaporanSidewallApiController::class, 'index'])->name('api.laporan-sidewall.list');
        Route::post('/sync', [LaporanSidewallApiController::class, 'sync'])->name('api.laporan-sidewall.sync');
    });

    Route::prefix('laporan-id-od')->group(function () {
        Route::get('/list', [LaporanIdOdApiController::class, 'index'])->name('api.laporan-id-od.list');
        Route::post('/sync', [LaporanIdOdApiController::class, 'sync'])->name('api.laporan-id-od.sync');
    });

    Route::prefix('form-check')->group(function () {
        Route::get('/list', [FormCheckApiController::class, 'index'])->name('api.form-check.list');
        Route::post('/sync', [FormCheckApiController::class, 'sync'])->name('api.form-check.sync');
    });

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

    // ==========================================
    // MODUL: VERIFIKASI STIKER (Mobile)
    // ==========================================
    Route::prefix('verifikasi-stiker')->group(function () {
        Route::get('/summary', [VerifikasiStikerApiController::class, 'getSummary'])->name('api.stiker.summary');
        Route::get('/list', [VerifikasiStikerApiController::class, 'getStikers'])->name('api.stiker.list');
        Route::get('/scan', [VerifikasiStikerApiController::class, 'scan'])->name('api.stiker.scan');
        Route::post('/validate/{id}', [VerifikasiStikerApiController::class, 'validateDirect'])->name('api.stiker.validate');
    });

    // ==========================================
    // MODUL: SETTING BREAK BULK (Mobile)
    // ==========================================
    Route::prefix('break-bulk')->group(function () {
        Route::get('/summary', [BreakBulkApiController::class, 'summary'])->name('api.break-bulk.summary');
        Route::get('/master-options', [BreakBulkApiController::class, 'masterOptions'])->name('api.break-bulk.master-options');
        Route::get('/catalog', [BreakBulkApiController::class, 'catalog'])->name('api.break-bulk.catalog');
        Route::get('/cek/{atribut}', [BreakBulkApiController::class, 'cekAtribut'])->name('api.break-bulk.cek');
        Route::get('/scans', [BreakBulkApiController::class, 'scans'])->name('api.break-bulk.scans');
        Route::post('/scan', [BreakBulkApiController::class, 'storeScan'])->name('api.break-bulk.scan.store');
        Route::delete('/scan/{id}', [BreakBulkApiController::class, 'destroyScan'])->name('api.break-bulk.scan.destroy');
        Route::get('/tonase', [BreakBulkApiController::class, 'tonase'])->name('api.break-bulk.tonase');
    });

    // ==========================================
    // MODUL: SCAN KOIL EUP (Mobile)
    // ==========================================
    Route::prefix('scan-koil-eup')->group(function () {
        Route::get('/summary', [ScanKoilEupApiController::class, 'summary'])->name('api.scan-koil-eup.summary');
        Route::get('/master-options', [ScanKoilEupApiController::class, 'masterOptions'])->name('api.scan-koil-eup.master-options');
        Route::get('/cek/{noCoil}', [ScanKoilEupApiController::class, 'cekCoil'])->name('api.scan-koil-eup.cek');
        Route::get('/scans', [ScanKoilEupApiController::class, 'scans'])->name('api.scan-koil-eup.scans');
        Route::post('/scan', [ScanKoilEupApiController::class, 'storeScan'])->name('api.scan-koil-eup.scan.store');
        Route::delete('/scan/{id}', [ScanKoilEupApiController::class, 'destroyScan'])->name('api.scan-koil-eup.scan.destroy');
        Route::get('/tonase', [ScanKoilEupApiController::class, 'tonase'])->name('api.scan-koil-eup.tonase');
    });

    // ==========================================
    // MODUL: VERIFIKASI TIMBANGAN (Mobile)
    // ==========================================
    Route::prefix('verifikasi-timbangan')->group(function () {
        Route::get('/summary', [VerifikasiTimbanganApiController::class, 'summary'])->name('api.timbangan.summary');
        Route::get('/list', [VerifikasiTimbanganApiController::class, 'index'])->name('api.timbangan.list');
        Route::post('/store', [VerifikasiTimbanganApiController::class, 'store'])->name('api.timbangan.store');
        Route::post('/tindak-lanjut/{id}', [VerifikasiTimbanganApiController::class, 'tindakLanjut'])->name('api.timbangan.tindak-lanjut');
        Route::put('/update/{id}', [VerifikasiTimbanganApiController::class, 'tindakLanjut'])->name('api.timbangan.update');
        Route::post('/update/{id}', [VerifikasiTimbanganApiController::class, 'tindakLanjut'])->name('api.timbangan.update.post');
        Route::delete('/destroy/{id}', [VerifikasiTimbanganApiController::class, 'destroy'])->name('api.timbangan.destroy');
    });

    // ==========================================
    // MODUL: STOCK OPNAME (Bahan Baku & Sparepart)
    // ==========================================
    Route::prefix('stock-opname')->group(function () {
        Route::get('/summary', [StockOpnameApiController::class, 'summary'])->name('api.stock-opname.summary');
        Route::get('/list', [StockOpnameApiController::class, 'list'])->name('api.stock-opname.list');
        Route::get('/lookup', [StockOpnameApiController::class, 'lookup'])->name('api.stock-opname.lookup');
        Route::post('/store', [StockOpnameApiController::class, 'store'])->name('api.stock-opname.store');
    });
});
