<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class BreakBulk extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'break_bulks';

    protected $fillable = [
        'no_urut',
        'atribut',
        'weight',
        'product',
        'no_so',
        'status',
        'scanned_at',
        'scanned_by',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'scanned_at' => 'datetime',
    ];
}
