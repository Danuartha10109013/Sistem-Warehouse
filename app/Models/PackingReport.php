<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackingReport extends Model
{
    protected $fillable = [
        'date',
        'attribute',
        'group',
        'layout',
        'no_so',
        'kondisi',
        'plastik',
        'wrapping',
        'impraboard',
        'idod',
        'pallet',
        'bandazer',
        'label',
        'inner',
        'outer',
        'lainnya',
    ];
}
