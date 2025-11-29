<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SACImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SAC;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SACController extends Controller
{

    public function autofill(Request $request)
{
    $attribute = $request->attribute;

    $data = SAC::where('kpc', $attribute)->first();


    if ($data) {
        return response()->json([
            'status' => true,
            'qty' => $data->berat,
            'lokasi' => $data->lokasi,
            'keterangan' => $data->keterangan,
            'scanner' => $data->scanner,
            'namabarang' => $data->namabarang,
        ]);
    }

    return response()->json(['status' => false]);
}

    public function index () {

        if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Silahkan Login terlbih dahulu');
            }
        $data = SAC::where('date', '>=', Carbon::now()->subMonth())
                ->orderBy('created_at', 'desc')
                ->get();
            return view ('so.index', compact('data'));
        }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls'
        ]);


        Excel::import(new SACImport, $request->file('excel'));

        return back()->with('success', 'Data berhasil diimport dari Excel');
    }

   public function store(Request $request){
    $kpc = $request->attribute;

    $id = SAC::where('kpc', $kpc)->value('id');
    if($id){
        $data = SAC::find($id);
        $data->lokasi_scan = $request->lokasi;
        $data->qty_scan = $request->qty;
        $data->keterangan = $request->keterangan;
        $data->date_scan = \Carbon\Carbon::now();
        $data->scanner = Auth::user()->name;
        $data->save();

        return redirect()->back()->with('success', 'Scan Telah berhasil');

    }else{
        $baru = new SAC();
        $baru->kpc = $kpc;
        $baru->barcode = $kpc;
        $baru->lokasi = $request->lokasi;

        $baru->berat = (int) $request->qty;
        $baru->qty_scan = (int) $request->qty;

        $baru->lokasi_scan = $request->lokasi;
        $baru->warehouse = 'WH';
        $baru->namabarang = $request->namabarang;
        $baru->jenis = 'manual';
        $baru->keterangan = $request->keterangan;

        $baru->date = \Carbon\Carbon::now();
        $baru->scanner = Auth::user()->name;
        $baru->date_scan = \Carbon\Carbon::now();

        $baru->save();

        return redirect()->back()->with('success', 'Data Manual Telah ditambahkan');

    }

}

}
