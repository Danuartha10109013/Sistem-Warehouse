<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'bahan_baku';
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'deskripsi_produk',
        'kategori_produk',
        'quantity',
        'storage_bin',
        'date_kedatangan',
        'date_keluar',
    ];
}
