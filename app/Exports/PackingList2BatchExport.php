<?php

namespace App\Exports;

use App\Models\PackingList2Batch;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PackingList2BatchExport implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    protected PackingList2Batch $batch;
    protected Collection $items;

    public function __construct(PackingList2Batch $batch, Collection $items)
    {
        $this->batch = $batch;
        $this->items = $items;
    }

    public function view(): View
    {
        return view('packing_list_2.exports.excel', [
            'batch' => $this->batch,
            'items' => $this->items,
        ]);
    }

    public function title(): string
    {
        // Sheet title max 31 chars in Excel
        $title = $this->batch->kode_batch ?: 'Batch';
        return substr($title, 0, 31);
    }
}
