<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiStiker extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_stikers';

    protected $fillable = [
        'tanggal_input',
        'produk',
        'attribute',
        'supplier_lot_no',
        'tgl_dn',
        'berat',
        'status_verifikasi',
        'check_produk',
        'check_lot_no',
        'check_berat',
        'verified_at',
        'verified_by',
        'catatan',
    ];

    protected $casts = [
        'tanggal_input'   => 'date',
        'berat'           => 'decimal:2',
        'check_produk'    => 'boolean',
        'check_lot_no'    => 'boolean',
        'check_berat'     => 'boolean',
        'verified_at'     => 'datetime',
    ];
}
