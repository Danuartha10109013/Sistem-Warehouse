<?php

namespace App\Traits;

use App\Services\LogActivity;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $module = static::getActivityModuleName();
            LogActivity::record(
                action: 'CREATE',
                module: $module,
                description: "Menambahkan data {$module} baru (ID: {$model->getKey()})",
                oldValues: null,
                newValues: $model->getAttributes()
            );
        });

        static::updated(function ($model) {
            $changes = $model->getChanges();
            
            // Abaikan jika hanya update updated_at / remember_token
            unset($changes['updated_at'], $changes['remember_token']);
            if (empty($changes)) {
                return;
            }

            $oldValues = [];
            foreach ($changes as $key => $newVal) {
                $oldValues[$key] = $model->getOriginal($key);
            }

            $module = static::getActivityModuleName();
            LogActivity::record(
                action: 'UPDATE',
                module: $module,
                description: "Mengubah data {$module} (ID: {$model->getKey()})",
                oldValues: $oldValues,
                newValues: $changes
            );
        });

        static::deleted(function ($model) {
            $module = static::getActivityModuleName();
            LogActivity::record(
                action: 'DELETE',
                module: $module,
                description: "Menghapus data {$module} (ID: {$model->getKey()})",
                oldValues: $model->getOriginal(),
                newValues: null
            );
        });
    }

    public static function getActivityModuleName(): string
    {
        $class = class_basename(static::class);
        $names = [
            'ShipA' => 'Ship Mark (A)',
            'ShipB' => 'Ship Mark (B)',
            'ShipC' => 'Ship Mark (C)',
            'ShipD' => 'Ship Mark (D)',
            'ShipE' => 'Ship Mark (E)',
            'Shipment' => 'Ship Mark / Shipment',
            'MapCoil' => 'Mapping',
            'MapCoilTruck' => 'Mapping Truk',
            'CraneM' => 'Form Check Crane',
            'ForkliftM' => 'Form Check Forklift',
            'Pengecekan' => 'Form Check Pengecekan',
            'OpenPack' => 'Open Packing',
            'PackingDetailM' => 'Open Packing (Detail)',
            'QROpenpackingModel' => 'Open Packing QR',
            'M_OpenPackInspection' => 'Report Open Pack',
            'KendaraanM' => 'Checklist Kendaraan',
            'TraillerM' => 'Checklist Kendaraan (Trailer)',
            'ScanLayoutM' => 'Scan Layout',
            'CoilDamageM' => 'Coil Damage',
            'SAC' => 'Stock Opname (SAC)',
            'SO_KBI' => 'Stock Opname (KBI)',
            'SuratM' => 'Surat Izin Keluar',
            'SuratJalan' => 'Surat Jalan',
            'PackingM' => 'Laporan Packing',
            'PackingReport' => 'Laporan Packing Report',
            'IDODModel' => 'Laporan ID OD',
            'SidewallModel' => 'Laporan Sidewall',
            'SidewallMaster' => 'Master Sidewall',
            'LaporanrepackingM' => 'Laporan Repacking',
            'KapasitasHistory' => 'Modul Kapasitas',
            'KapasitasM' => 'Modul Kapasitas',
            'RekapPrd' => 'Rekap Hasil PRD & Pengeluaran',
            'VerifikasiTimbangan' => 'Verifikasi Timbangan',
            'ScanKoilEup' => 'Scan Koil EUP',
            'ScanKoilLayout' => 'Scan Koil Layout',
            'ScanKoilPalet' => 'Scan Koil Palet',
            'MasterProduct' => 'Master Product',
            'DailyStock' => 'Update Stock (Daily)',
            'Stock' => 'Update Stock',
            'KodeBahanBaku' => 'Stock Bahan Baku',
            'User' => 'Kelola User',
        ];

        return $names[$class] ?? $class;
    }
}
