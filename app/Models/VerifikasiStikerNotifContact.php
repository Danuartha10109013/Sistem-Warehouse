<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiStikerNotifContact extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_stiker_notif_contacts';

    protected $fillable = [
        'nama',
        'nomor_wa',
        'jabatan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk mengambil kontak aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

