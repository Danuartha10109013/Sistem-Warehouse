<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_OpenPackInspection;
use App\Services\OpenPackPdfExportService;

class ReportOpenPackController extends Controller
{
    public function index()
    {
        $history = M_OpenPackInspection::orderBy('id', 'desc')->get();
        return view('report-open-pack.index', compact('history'));
    }

    public function exportPdf(OpenPackPdfExportService $pdfService, $id)
    {
        return $pdfService->export($id);
    }
}
