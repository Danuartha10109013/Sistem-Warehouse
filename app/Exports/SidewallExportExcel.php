<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SidewallExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct(
        protected Collection $records,
        protected array $filters,
    ) {}

    public function view(): View
    {
        return view('laporansidewall.export', [
            'records' => $this->records,
            'filters' => $this->filters,
        ]);
    }
}
