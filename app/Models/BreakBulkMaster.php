<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class BreakBulkMaster extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'break_bulk_masters';

    protected $fillable = [
        'kategori',
        'nama',
        'keterangan',
    ];
}
