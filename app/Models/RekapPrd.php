<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPrd extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'hasil_prd',
        'pengeluaran_tml',
        'pengeluaran_ttl',
        'total_pengeluaran',
        'sisa_stock',
    ];
}
