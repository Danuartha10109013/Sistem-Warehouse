<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    /**
     * Kirim notifikasi push ke satu token FCM spesifik.
     */
    public static function sendToToken(string $fcmToken, string $title, string $body, array $data = []): array
    {
        if (empty($fcmToken)) {
            return ['success' => false, 'message' => 'Token FCM kosong.'];
        }

        $serviceAccountPath = storage_path('app/firebase/service-account.json');
        
        // Mode 1: Firebase HTTP v1 jika service-account.json tersedia
        if (file_exists($serviceAccountPath)) {
            try {
                $accessToken = self::getGoogleAccessToken($serviceAccountPath);
                $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);
                $projectId = $serviceAccount['project_id'] ?? 'simo-tml';

                $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

                $payload = [
                    'message' => [
                        'token' => $fcmToken,
                        'notification' => [
                            'title' => $title,
                            'body'  => $body,
                        ],
                        'data' => array_map('strval', $data),
                        'android' => [
                            'priority' => 'high',
                            'notification' => [
                                'sound' => 'default',
                                'channel_id' => 'simo_warehouse_high_importance',
                            ],
                        ],
                    ],
                ];

                $response = Http::withToken($accessToken)
                    ->post($url, $payload);

                if ($response->successful()) {
                    Log::info("[FCM] Push terkirim ke {$fcmToken}: {$title}");
                    return ['success' => true, 'response' => $response->json()];
                } else {
                    Log::warning("[FCM] Gagal mengirim: " . $response->body());
                    return ['success' => false, 'message' => $response->body()];
                }
            } catch (\Throwable $e) {
                Log::error("[FCM] Exception: " . $e->getMessage());
                return ['success' => false, 'message' => $e->getMessage()];
            }
        }

        // Mode 2: Firebase Server Key Legacy jika diset di .env
        $serverKey = env('FIREBASE_SERVER_KEY');
        if (!empty($serverKey)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'key=' . $serverKey,
                    'Content-Type'  => 'application/json',
                ])->post('https://fcm.googleapis.com/fcm/send', [
                    'to' => $fcmToken,
                    'notification' => [
                        'title' => $title,
                        'body'  => $body,
                        'sound' => 'default',
                    ],
                    'data' => $data,
                    'priority' => 'high',
                ]);

                return ['success' => $response->successful(), 'response' => $response->json()];
            } catch (\Throwable $e) {
                Log::error("[FCM Legacy] Error: " . $e->getMessage());
                return ['success' => false, 'message' => $e->getMessage()];
            }
        }

        Log::info("[FCM Simulated] Notification queued for {$fcmToken}: {$title} - {$body}");
        return [
            'success' => true,
            'simulated' => true,
            'message' => 'Simulated: Letakkan service-account.json di storage/app/firebase/ untuk push server langsung.',
        ];
    }

    /**
     * Kirim notifikasi push ke seluruh operator gudang yang memiliki fcm_token.
     */
    public static function sendToAllOperators(string $title, string $body, array $data = []): array
    {
        $tokens = User::whereNotNull('fcm_token')
            ->where('fcm_token', '!=', '')
            ->pluck('fcm_token')
            ->unique();

        $successCount = 0;
        foreach ($tokens as $token) {
            $res = self::sendToToken($token, $title, $body, $data);
            if ($res['success']) {
                $successCount++;
            }
        }

        return [
            'success' => true,
            'total_targets' => count($tokens),
            'sent_count' => $successCount,
        ];
    }

    /**
     * Trigger alert saat batch baru diunggah & siap divalidasi.
     */
    public static function sendBatchReadyAlert(string $batchNumber, int $totalCoils): array
    {
        return self::sendToAllOperators(
            title: 'Batch Baru Siap Divalidasi',
            body: "Batch {$batchNumber} dengan {$totalCoils} koil telah siap diperiksa di lapangan.",
            data: [
                'type' => 'batch_new',
                'batch_number' => $batchNumber,
                'total_coils' => (string) $totalCoils,
            ]
        );
    }

    /**
     * Helper membuat OAuth2 JWT Google Access Token dari service-account.json.
     */
    private static function getGoogleAccessToken(string $serviceAccountPath): string
    {
        $json = json_decode(file_get_contents($serviceAccountPath), true);
        $now = time();

        $header = base64_encode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
        $claim = base64_encode(json_encode([
            'iss' => $json['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
        ]));

        $signature = '';
        openssl_sign("$header.$claim", $signature, $json['private_key'], 'SHA256');
        $jwt = "$header.$claim." . base64_encode($signature);

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ]);

        return $response->json('access_token');
    }
}

