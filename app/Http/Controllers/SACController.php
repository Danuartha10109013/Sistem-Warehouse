<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SACController extends Controller
{
    public function index () {

        $data = '';
        return view ('so.index', compact('data'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new PackingImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimport dari Excel');
    }
}
