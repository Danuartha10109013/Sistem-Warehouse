<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapNoSo extends Model
{
    use HasFactory;

    protected $table = 'rekap_no_sos';

    protected $fillable = [
        'attribute',
        'no_so',
        'catatan',
    ];
}
