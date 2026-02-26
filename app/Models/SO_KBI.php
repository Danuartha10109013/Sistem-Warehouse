<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SO_KBI extends Model
{
    protected $table = 'so_kbi';
    protected $fillable = [
        'date',
        'so',
        'delivery_no',
        'coil_no',
        'delv_weight',
        'thick',
        'width_batch',
        'thicknes',
        'storagebin_kbi',
        'status',
        'coil_scan',
        'weight_scan',
        'waktu_scan',
        'scanner',
        'keterangan',
    ];
}
