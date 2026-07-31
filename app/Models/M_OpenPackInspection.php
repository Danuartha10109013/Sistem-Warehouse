<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_OpenPackInspection extends Model
{
    use HasFactory;

    protected $table = 'open_pack_inspections';

    protected $fillable = [
        'crc_id',
        'attribute',
        'nomor_coil_supplier',
        'tanggal_kedatangan',
        'nomor_surat_jalan',
        'nama_supplier',
        'tanggal_open_pack',
        'grup',
        'kondisi_awal',
        'kondisi_setelah_open_pack',
        'keterangan',
        'created_by',
    ];

    public function crc()
    {
        return $this->belongsTo(CrcM::class, 'crc_id');
    }

    public function photos()
    {
        return $this->hasMany(M_OpenPackInspectionPhoto::class, 'open_pack_inspection_id');
    }
}
