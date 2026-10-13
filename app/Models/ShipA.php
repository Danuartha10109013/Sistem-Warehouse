<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class ShipA extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'shippmenta';
    protected $fillable = [
        'atribute',
        'unicode',
        'size',
        'weight',
        'satuan_berat',
        'destination',
        'type',

    ];
}
