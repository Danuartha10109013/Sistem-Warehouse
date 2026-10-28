<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class VerifikasiStikerHasilScanExport implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    protected string $tanggal;
    protected Collection $items;
    protected array $summary;

    public function __construct(string $tanggal, Collection $items, array $summary)
    {
        $this->tanggal = $tanggal;
        $this->items = $items;
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('verifikasi_stiker.exports.hasil_scan_excel', [
            'tanggal' => $this->tanggal,
            'items'   => $this->items,
            'summary' => $this->summary,
        ]);
    }

    public function title(): string
    {
        return 'Hasil Scan ' . str_replace('/', '-', $this->tanggal);
    }
}
