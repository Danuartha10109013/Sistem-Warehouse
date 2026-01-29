<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeBahanBaku extends Model
{
    protected $table = 'kode_produk_bb';
    protected $fillable = [
        'supplier',
        'kode_produk',
        'kategori',
        'origin',
        'attribute_code',
        'jenis',
    ];
}
