<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PackingList2LaporanHarianExport implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    protected string $tanggal;
    protected Collection $batches;
    protected array $summary;

    public function __construct(string $tanggal, Collection $batches, array $summary)
    {
        $this->tanggal = $tanggal;
        $this->batches = $batches;
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('packing_list_2.exports.laporan_harian_excel', [
            'tanggal' => $this->tanggal,
            'batches' => $this->batches,
            'summary' => $this->summary,
        ]);
    }

    public function title(): string
    {
        return 'Laporan ' . $this->tanggal;
    }
}
