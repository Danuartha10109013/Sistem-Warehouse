<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class RekapPrd extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'tanggal',
        'hasil_prd',
        'pengeluaran_tml',
        'pengeluaran_ttl',
        'total_pengeluaran',
        'sisa_stock',
    ];
}
