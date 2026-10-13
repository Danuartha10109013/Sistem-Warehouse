<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class PackingDetailM extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'packing_detail';

    protected $fillable = [
        'attribute',
        'b_label',
        'b_aktual',
        'selisih',
        'persentase',
        'stiker',
        'keterangan',
        'gm',
        'operator',
        'shift',
        'shift_leader',
        'checks',
    ];
    
}
