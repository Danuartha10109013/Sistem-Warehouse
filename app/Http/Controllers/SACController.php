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
            'storagebin' => $data->storagebin,
            'qty_scan' => $data->qty_scan ?? 0,
            'selisih' => ($data->berat ?? 0) - ($data->qty_scan ?? 0),
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

    public function utama () {

    if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlbih dahulu');
        }
    $data = SAC::where('date', '>=', Carbon::now()->subMonth())
            ->orderBy('created_at', 'desc')
            ->get();
        return view ('so.utama', compact('data'));
    }
    public function cs () {

        if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Silahkan Login terlbih dahulu');
            }
        $data = SAC::where('date', '>=', Carbon::now()->subMonth())
                ->orderBy('created_at', 'desc')
                ->get();
            return view ('so.cs', compact('data'));
    }

    public function import(Request $request)
{
    $request->validate([
        'excel' => 'required|mimes:xlsx,xls'
    ]);

    $kategori = $request->kategori;

    Excel::import(new SACImport($kategori), $request->file('excel'));

    return back()->with('success', 'Data berhasil diimport dari Excel');
}


   public function store(Request $request){
    $kpc = $request->attribute;

    $id = SAC::where('kpc', $kpc)->value('id');
    if($id){
        $data = SAC::find($id);
        $existingQty = (int) ($data->qty_scan ?? 0);
        $newQty = (int) $request->qty;

        $data->lokasi_scan = $request->lokasi;
        // jumlahkan qty scan lama + baru
        $data->qty_scan = $existingQty + $newQty;

        // susun keterangan scan bertingkat (lebih mudah dibaca)
        $user = Auth::user()->name;
        $baseKeterangan = $data->keterangan ?? '';

        // cari nomor scan terakhir di keterangan (Scan 1, Scan 2, dst)
        $scanNumber = 1;
        if (preg_match_all('/Scan\s+(\d+)/i', $baseKeterangan, $matches) && count($matches[1]) > 0) {
            $scanNumber = ((int) max($matches[1])) + 1;
        } elseif ($existingQty > 0) {
            // sudah pernah discan tapi belum ada pola "Scan X"
            $scanNumber = 2;
        }

        $note = "Scan {$scanNumber} - {$user} - Qty: {$newQty}";
        // jika storagebin hasil berbeda dengan storagebin awal, catat perubahannya
        $originalSB = $data->storagebin ?? null;
        $resultSB = $request->layout;
        if ($resultSB && $originalSB && $resultSB !== $originalSB) {
            $note .= " (SB: {$originalSB} -> {$resultSB})";
        } elseif ($resultSB && !$originalSB) {
            $note .= " (SB: {$resultSB})";
        }
        if ($request->keterangan) {
            $note .= " | Catatan: " . $request->keterangan;
        }

        if ($baseKeterangan) {
            // tiap scan pada baris baru
            $data->keterangan = $baseKeterangan . "\n" . $note;
        } else {
            $data->keterangan = $note;
        }

        $data->storagebin_hasil = $request->layout;
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
        $note = "Scan 1 - " . Auth::user()->name . " - Qty: " . (int) $request->qty;
        if ($request->layout) {
            $note .= " (SB: {$request->layout})";
        }
        if ($request->keterangan) {
            $note .= " | Catatan: " . $request->keterangan;
        }
        $baru->keterangan = $note;
        $baru->storagebin_hasil = $request->layout;

        $baru->date = \Carbon\Carbon::now();
        $baru->scanner = Auth::user()->name;
        $baru->date_scan = \Carbon\Carbon::now();

        $baru->save();

        return redirect()->back()->with('success', 'Data Manual Telah ditambahkan');

    }

}

    public function sparepart () {

    if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlbih dahulu');
        }

        $key = 'SPAREPART';

    $data = SAC::where('date', '>=', Carbon::now()->subMonth())
            ->orderBy('created_at', 'desc')
            ->get();
        return view ('so.index', compact('data','key'));
    }

public function electric (){
    return view ('so.cs');
}
public function mechanic (){
    return view ('so.cs');
}
public function proyek (){
    return view ('so.cs');
}
public function safety (){
    return view ('so.cs');
}
public function utility (){
    return view ('so.cs');
}
public function general (){
    return view ('so.cs');
}

}
