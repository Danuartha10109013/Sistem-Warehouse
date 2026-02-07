<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QROpenpackingModel extends Model
{
    protected $table = 'qropenpack';

    protected $fillable = [
        'kpc'
    ];
}
