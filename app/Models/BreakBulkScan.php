<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class BreakBulkScan extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'break_bulk_scans';

    protected $fillable = [
        'atribut',
        'trailer',
        'weight',
        'product',
        'grouping',
        'pod',
        'no_so',
        'lokasi',
        'scanned_by',
        'scanned_at',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'scanned_at' => 'datetime',
    ];
}
