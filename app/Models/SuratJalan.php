<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $table = 'surat_jalan';

    protected $fillable = [
        'no_surat_jalan',
        'business_partner',
        'foto_scan',
        'receive_date',
    ];

    protected $casts = [
        'receive_date' => 'date',
    ];
}
