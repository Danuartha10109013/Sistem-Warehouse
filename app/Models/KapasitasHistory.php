<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class KapasitasHistory extends Model
{
    use LogsActivity;
    protected $fillable = [
        'bulan',
        'tahun',
        'kapasitas_crc',
        'kapasitas_barang_jadi'
    ];
}
