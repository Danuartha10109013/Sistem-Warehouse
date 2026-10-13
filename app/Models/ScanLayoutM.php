<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class ScanLayoutM extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'scan_layout';

    protected $fillable = [
        'attribute',
        'layout',
        'kondisi',
        'group',
        'user_id',
    ];

}
