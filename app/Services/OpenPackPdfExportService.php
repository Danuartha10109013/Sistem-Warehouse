<?php

namespace App\Services;

use App\Models\M_OpenPackInspection;
use Barryvdh\DomPDF\Facade\Pdf;

class OpenPackPdfExportService
{
    public function export($id)
    {
        $inspection = M_OpenPackInspection::with('photos')->findOrFail($id);

        $photos = [];
        foreach ($inspection->photos as $photo) {
            // $photo->file_path is like 'storage/open_pack_photos/xxxx.png'
            $relativePath = str_replace('storage/', '', $photo->file_path);
            $path = storage_path('app/public/' . $relativePath);
            
            if (file_exists($path)) {
                $photos[$photo->slot_key] = $path;
            }
        }

        $pdf = Pdf::loadView('pdf.open-pack-inspection', [
            'inspection' => $inspection,
            'photos' => $photos
        ]);

        return $pdf->download('Report_Open_Pack_' . $inspection->attribute . '.pdf');
    }
}
