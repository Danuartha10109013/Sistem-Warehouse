<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$img = App\Models\M_OpenPackInspectionPhoto::first();
if (!$img) { echo "No photo found\n"; exit; }
$path = storage_path('app/public/' . str_replace('storage/', '', $img->file_path));
echo "Path: $path\n";
echo "Exists: " . (file_exists($path) ? 'Yes' : 'No') . "\n";
if (file_exists($path)) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    echo "Base64 prefix: " . substr($base64, 0, 50) . "\n";
    echo "Size: " . strlen($base64) . " bytes\n";
}
