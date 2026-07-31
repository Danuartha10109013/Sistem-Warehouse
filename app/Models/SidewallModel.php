<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SidewallModel extends Model
{
    protected $table = 'sidewall';

    protected $fillable = [
        'date',
        'size_sidewall',
        'jumlah',
        'tujuan',
        'keterangan',
        'shift',
    ];

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
