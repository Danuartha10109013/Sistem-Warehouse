<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingList2Batch extends Model
{
    use HasFactory;

    protected $table = 'packing_list2_batches';

    protected $fillable = [
        'kode_batch',
        'no_rit',
        'user_id',
        'total_item',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(PackingList2Item::class, 'batch_id');
    }

    public function canBeDeleted(): bool
    {
        // Batch dapat dihapus oleh operator / admin
        return true;
    }
}
