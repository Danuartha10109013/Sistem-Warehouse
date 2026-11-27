<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileSyncEvent extends Model
{
    use HasFactory;

    protected $table = 'mobile_sync_events';

    protected $fillable = [
        'event_id',
        'module',
        'aggregate_id',
        'event_type',
        'payload',
        'device_id',
        'user_id',
        'client_timestamp',
        'synced_at',
        'status',
        'error_message',
    ];

    protected $casts = [
        'payload'          => 'array',
        'client_timestamp' => 'datetime',
        'synced_at'        => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
