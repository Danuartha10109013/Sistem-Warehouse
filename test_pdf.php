<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$img = App\Models\M_OpenPackInspectionPhoto::first();
$path = storage_path('app/public/' . str_replace('storage/', '', $img->file_path));
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$html = '<html><body><h1>Base64 Test</h1><img src="' . $base64 . '" width="200"></body></html>';
$pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
$pdf->save(storage_path('app/test.pdf'));
echo 'Saved test.pdf';
