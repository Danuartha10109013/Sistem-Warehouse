<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class DailyStock extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'tanggal',
        'source',
        'kategori',
        'quantity',
    ];
}
