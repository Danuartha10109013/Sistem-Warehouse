<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingList2Item extends Model
{
    use HasFactory;

    protected $table = 'packing_list2_items';

    protected $fillable = [
        'batch_id',
        'kode',
        'nama_produk',
        'qty',
        'uom',
        'no_coil',
        'storage_bin',
        'tanggal',
        'pengirim',
        'panjang',
        'time',
        'kondisi',
        'tujuan',
        'keterangan',
        'status',
        'checklist_result',
        'catatan_verifikasi',
        'validated_by',
        'validated_at',
    ];

    protected $casts = [
        'qty' => 'float',
        'panjang' => 'float',
        'tanggal' => 'date',
        'time' => 'datetime',
        'validated_at' => 'datetime',
        'checklist_result' => 'array',
    ];

    public function batch()
    {
        return $this->belongsTo(PackingList2Batch::class, 'batch_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
