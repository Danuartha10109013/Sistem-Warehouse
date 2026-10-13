<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class ShipD extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'shippmentd';

    // Define the fillable fields
    protected $fillable = [
        'atribute',
        'unicode',
        'destination',
        'type',
        'size'
    ];
}
