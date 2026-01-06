<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SAC extends Model
{

    protected $table = 'sac';
    protected $fillable = [
        'date',
        'warehouse',
        'kpc',
        'barcode',
        'namabarang',
        'berat',
        'lokasi',
        'jenis',
        'date_scan',
        'lokasi_scan',
        'qty_scan',
        'keterangan',
        'scanner',
        'storagebin',
        'storagebin_hasil',
    ];
}
