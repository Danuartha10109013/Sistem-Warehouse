<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ShipF extends Model
{
    use LogsActivity;

    protected $table = 'shippmentf';

    protected $fillable = ['no_so', 'reference', 'destination', 'attribute'];
}
