<?php

namespace App\Services;

use App\Models\VerifikasiStiker;
use App\Models\VerifikasiStikerNotifContact;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppNotificationService
{
    /**
     * Kirim pesan notifikasi ketidaksesuaian stiker ke semua kontak aktif
     */
    public static function sendMismatchAlert(VerifikasiStiker $item): array
    {
        $contacts = VerifikasiStikerNotifContact::active()->get();

        if ($contacts->isEmpty()) {
            return [
                'success' => false,
                'message' => 'Tidak ada kontak penerima notifikasi aktif.',
            ];
        }

        $targets = $contacts->pluck('nomor_wa')->map(function ($no) {
            return preg_replace('/[^0-9]/', '', $no);
        })->filter()->implode(',');

        if (empty($targets)) {
            return [
                'success' => false,
                'message' => 'Nomor WhatsApp penerima tidak valid.',
            ];
        }

        $token = env('FONNTE_TOKEN', config('services.fonnte.token'));

        if (empty($token)) {
            Log::warning('[WA_NOTIF] FONNTE_TOKEN belum diset di .env');
            return [
                'success' => false,
                'message' => 'FONNTE_TOKEN belum dikonfigurasi di file .env',
            ];
        }

        // Susun teks rincian ceklis yang gagal
        $gagal = [];
        if (!$item->check_produk) {
            $gagal[] = "❌ Produk/Item Tidak Cocok";
        }
        if (!$item->check_lot_no) {
            $gagal[] = "❌ Supplier Lot No Tidak Cocok";
        }
        if (!$item->check_berat) {
            $gagal[] = "❌ Berat Timbangan Tidak Cocok";
        }
        $rincianGagal = empty($gagal) ? "Tidak diketahui" : implode("\n", $gagal);

        $waktu = $item->verified_at ? $item->verified_at->format('d/m/Y H:i:s') : now()->format('d/m/Y H:i:s');
        $beratFormatted = number_format($item->berat, 2, '.', ',');

        $message = "⚠️ *PERINGATAN: VERIFIKASI STIKER TIDAK SESUAI*\n"
                 . "PT Tata Metal Lestari - Sistem Warehouse\n"
                 . "─────────────────────────\n"
                 . "📌 *Attribute:* {$item->attribute}\n"
                 . "🏷️ *Produk:* {$item->produk}\n"
                 . "🔢 *Lot No:* {$item->supplier_lot_no}\n"
                 . "⚖️ *Berat:* {$beratFormatted} kg\n"
                 . "─────────────────────────\n"
                 . "🔍 *Rincian Masalah:*\n{$rincianGagal}\n"
                 . "─────────────────────────\n"
                 . "📝 *Catatan:* " . ($item->catatan ?: '-') . "\n"
                 . "👤 *Verifikator:* {$item->verified_by}\n"
                 . "⏰ *Waktu Scan:* {$waktu}\n"
                 . "─────────────────────────\n"
                 . "_Pesan otomatis dari Sistem Informasi Digital Warehouse_";

        return self::sendViaFonnte($targets, $message, $token);
    }

    /**
     * Kirim pesan tes langsung ke satu atau banyak nomor
     */
    public static function sendTestMessage(string $targets, string $customMessage = null): array
    {
        $token = env('FONNTE_TOKEN', config('services.fonnte.token'));

        if (empty($token)) {
            return [
                'success' => false,
                'message' => 'FONNTE_TOKEN belum dikonfigurasi di file .env',
            ];
        }

        $message = $customMessage ?: ("✅ *TEST NOTIFIKASI WHATSAPP*\n"
                 . "Sistem Verifikasi Stiker - PT Tata Metal Lestari\n"
                 . "Pesan ini dikirim untuk memastikan gateway Fonnte berfungsi dengan baik.\n"
                 . "Waktu: " . now()->format('d/m/Y H:i:s'));

        return self::sendViaFonnte($targets, $message, $token);
    }

    /**
     * Cek status koneksi device dan sisa limit kuota di Fonnte
     */
    public static function getDeviceStatus(): array
    {
        $token = env('FONNTE_TOKEN', config('services.fonnte.token'));

        if (empty($token)) {
            return [
                'success'       => false,
                'device_status' => 'no_token',
                'message'       => 'FONNTE_TOKEN belum dikonfigurasi di file .env',
            ];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->timeout(8)->post('https://api.fonnte.com/device');

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === true) {
                return [
                    'success'       => true,
                    'device_status' => $result['device_status'] ?? 'unknown', // 'connect' / 'disconnect'
                    'device'        => $result['device'] ?? null,
                    'name'          => $result['name'] ?? null,
                    'package'       => $result['package'] ?? null,
                    'quota'         => isset($result['quota']) ? (int) $result['quota'] : 0,
                    'messages'      => isset($result['messages']) ? (int) $result['messages'] : 0,
                    'expired'       => $result['expired'] ?? null,
                    'raw'           => $result,
                ];
            }

            return [
                'success'       => false,
                'device_status' => 'disconnect',
                'message'       => $result['reason'] ?? 'Gagal mengambil status device dari Fonnte.',
            ];
        } catch (\Exception $e) {
            Log::error('[WA_FONNTE_DEVICE_CHECK_FAIL] ' . $e->getMessage());

            return [
                'success'       => false,
                'device_status' => 'error',
                'message'       => 'Koneksi ke Fonnte gagal: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Eksekusi HTTP Request ke API Fonnte
     */
    protected static function sendViaFonnte(string $targets, string $message, string $token): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->timeout(15)->post('https://api.fonnte.com/send', [
                'target'      => $targets,
                'message'     => $message,
                'countryCode' => '62',
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === true) {
                return [
                    'success' => true,
                    'message' => 'Notifikasi WhatsApp berhasil dikirim via Fonnte.',
                    'data'    => $result,
                ];
            }

            Log::error('[WA_NOTIF_ERROR] Fonnte response error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return [
                'success' => false,
                'message' => $result['reason'] ?? 'Gagal mengirim pesan via Fonnte (HTTP ' . $response->status() . ').',
                'data'    => $result,
            ];
        } catch (\Exception $e) {
            Log::error('[WA_NOTIF_EXCEPTION] ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi ke Fonnte: ' . $e->getMessage(),
            ];
        }
    }
}

