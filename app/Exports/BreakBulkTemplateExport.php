<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class BreakBulkTemplateExport implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    public function view(): View
    {
        return view('break_bulk.exports.template_excel');
    }

    public function title(): string
    {
        return 'Template Break Bulk';
    }
}
