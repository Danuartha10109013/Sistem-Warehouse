<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\KodeBahanBaku;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $key = 'Stock';
        $kategori = KodeBahanBaku::all();
        $data = Stock::all();
        return view('stock.index', compact('key', 'data', 'kategori'));
    }
}
