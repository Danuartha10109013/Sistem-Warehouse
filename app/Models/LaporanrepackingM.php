<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LaporanrepackingM extends Model
{
    protected $table = 'laporanrepacking';

    protected $fillable = [
        'atributte',
        'tanggal',
        'status',
        'group',
        'wrapping',
        'vcipaper',
        'keterangan',
        'created_by',
    ];

    public function getReportDateAttribute(): ?Carbon
    {
        if (empty($this->tanggal)) {
            return $this->created_at ? Carbon::parse($this->created_at) : null;
        }

        try {
            return Carbon::parse($this->tanggal);
        } catch (\Throwable) {
            return $this->created_at ? Carbon::parse($this->created_at) : null;
        }
    }

    public function scopeInReportRange(Builder $query, string $from, string $to): Builder
    {
        $start = Carbon::parse($from)->toDateString();
        $end = Carbon::parse($to)->toDateString();
        $dateSql = "COALESCE(STR_TO_DATE(NULLIF(TRIM(tanggal), ''), '%Y-%m-%d'), DATE(created_at))";

        return $query->whereRaw("{$dateSql} BETWEEN ? AND ?", [$start, $end]);
    }
}
