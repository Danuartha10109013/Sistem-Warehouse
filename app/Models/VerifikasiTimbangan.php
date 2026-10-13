<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class VerifikasiTimbangan extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'verifikasi_timbangans';

    protected $fillable = [
        'tanggal',
        'label',
        'actual',
        'selisih',
        'status',
        'tindak_lanjut',
        'actual_setelah',
        'selisih_setelah',
        'operator_name'
    ];
}
