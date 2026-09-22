<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScanKoilEup extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function layout()
    {
        return $this->belongsTo(ScanKoilLayout::class, 'layout_id');
    }

    public function palet()
    {
        return $this->belongsTo(ScanKoilPalet::class, 'palet_id');
    }
}
