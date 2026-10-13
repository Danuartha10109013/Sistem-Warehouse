<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class MasterProduct extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'search_key',
        'name',
        'foto',
    ];
}
