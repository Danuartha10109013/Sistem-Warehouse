<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;

class ScanKoilEup extends Model
{
    use HasFactory, LogsActivity;
    
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
