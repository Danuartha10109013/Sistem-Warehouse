<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$img = App\Models\M_OpenPackInspectionPhoto::first();
$path = storage_path('app/public/' . str_replace('storage/', '', $img->file_path));

$html = '<html><body><h1>Physical Path Test</h1><img src="' . $path . '" width="200"></body></html>';
$pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
$pdf->save(storage_path('app/test2.pdf'));
echo 'Saved test2.pdf';
