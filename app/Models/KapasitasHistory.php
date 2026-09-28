<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KapasitasHistory extends Model
{
    protected $fillable = [
        'bulan',
        'tahun',
        'kapasitas_crc',
        'kapasitas_barang_jadi'
    ];
}
