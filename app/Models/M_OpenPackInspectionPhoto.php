<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_OpenPackInspectionPhoto extends Model
{
    use HasFactory;

    protected $table = 'open_pack_inspection_photos';

    protected $fillable = [
        'open_pack_inspection_id',
        'slot_key',
        'file_path',
    ];

    public function inspection()
    {
        return $this->belongsTo(M_OpenPackInspection::class, 'open_pack_inspection_id');
    }
}
