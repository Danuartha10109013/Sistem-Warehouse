<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();
$rows = \App\Models\ScanKoilEup::latest()->take(5)->get();
echo json_encode($rows, JSON_PRETTY_PRINT);
