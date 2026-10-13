<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogActivity
{
    /**
     * Catat log aktivitas user ke database.
     *
     * @param string $action CREATE|UPDATE|DELETE|LOGIN|LOGOUT|CUSTOM
     * @param string|null $module Nama modul terkait
     * @param string|null $description Ringkasan yang dilakukan
     * @param array|null $oldValues Data sebelum perubahan
     * @param array|null $newValues Data sesudah perubahan
     */
    public static function record(
        string $action,
        ?string $module = null,
        ?string $description = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): void {
        try {
            $user = Auth::user();

            ActivityLog::create([
                'user_id'     => $user ? $user->id : null,
                'user_name'   => $user ? ($user->name ?? $user->username) : 'Guest/System',
                'action'      => strtoupper($action),
                'module'      => $module,
                'description' => $description,
                'old_values'  => $oldValues,
                'new_values'  => $newValues,
                'ip_address'  => Request::ip(),
                'user_agent'  => Request::userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Hindari memblokir alur utama jika logging gagal
            \Log::error('Gagal mencatat log aktivitas: ' . $e->getMessage());
        }
    }
}
