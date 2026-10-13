<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class ShipB extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'shippmentb';
    protected $fillable = [
        'atribute',
        'manufactur',
        'product',
        'size',
        'gros',
        'net',
        'satuan_berat',
        'destination',
        'type',
    ];

}
