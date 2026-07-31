<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidewallMaster extends Model
{
    use HasFactory;

    protected $table = 'sidewall_masters';

    protected $fillable = [
        'type',
        'value'
    ];
}
