<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IDODModel extends Model
{
    protected $table = 'idod_tabel';

    protected $fillable = [
        'date',
        'size_id',
        'jumlah_id',
        'jumlah_id_ng',
        'size_od',
        'jumlah_od',
        'jumlah_od_ng',
        'tujuan',
        'keterangan',
        'shift',
    ];

    protected $casts = [
        'jumlah_id' => 'integer',
        'jumlah_id_ng' => 'integer',
        'jumlah_od' => 'integer',
        'jumlah_od_ng' => 'integer',
    ];

    public function getTotalJumlahAttribute(): int
    {
        return (int) $this->jumlah_id + (int) $this->jumlah_od;
    }

    public function getTotalJumlahNgAttribute(): int
    {
        return (int) $this->jumlah_id_ng + (int) $this->jumlah_od_ng;
    }

    public function getReportDateAttribute(): ?Carbon
    {
        if (empty($this->date)) {
            return $this->created_at ? Carbon::parse($this->created_at) : null;
        }

        try {
            return Carbon::parse($this->date);
        } catch (\Throwable) {
            return $this->created_at ? Carbon::parse($this->created_at) : null;
        }
    }

    public function scopeInReportRange(Builder $query, string $from, string $to): Builder
    {
        $start = Carbon::parse($from)->toDateString();
        $end = Carbon::parse($to)->toDateString();
        $dateSql = "COALESCE(STR_TO_DATE(NULLIF(TRIM(date), ''), '%Y-%m-%d'), DATE(created_at))";

        return $query->whereRaw("{$dateSql} BETWEEN ? AND ?", [$start, $end]);
    }
}
