<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SACImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SAC;
use App\Models\SO_KBI;
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

    public function autofillKbi(Request $request)
    {
        $attribute = $request->attribute;

        // Cari berdasarkan nomor coil di tabel khusus KBI
        $data = SO_KBI::where('coil_no', $attribute)->first();

        if ($data) {
            $berat   = $data->delv_weight ?? 0;
            $qtyScan = $data->weight_scan ?? 0;

            return response()->json([
                'status'       => true,
                // kolom Qty di form diisi dari delv_weight
                'qty'          => $berat,
                // kolom Lokasi diisi dari storagebin_kbi
                'lokasi'       => $data->storagebin_kbi,
                // kolom Nama Barang diisi dari thicknes (sesuai permintaan)
                'namabarang'   => $data->thicknes,
                'keterangan'   => $data->keterangan,
                'scanner'      => $data->scanner,
                'storagebin'   => $data->storagebin_kbi,
                'qty_scan'     => $qtyScan,
                'weight_scan'  => $data->weight_scan,
                'waktu_scan'   => $data->waktu_scan,
                'selisih'      => (float)$berat - (float)$qtyScan,
            ]);
        }

        return response()->json(['status' => false]);
    }

    public function index ()
    {
        return redirect()->route('so.sparepart');
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

        // susun riwayat scan dalam format terstruktur:
        // 1. Nama -> Qty : X | SB : Y
        $user = Auth::user()->name;
        $baseText = $data->keterangan ?? '';

        // pecah keterangan lama ke dalam array baris (setiap baris = 1 scan)
        $lines = array_filter(preg_split("/\r\n|\n|\r/", $baseText));
        $scanNumber = count($lines) + 1;

        // siapkan info storagebin untuk ditampilkan
        $originalSB = $data->storagebin ?? null;
        $resultSB = $request->layout;
        $sbDisplay = $resultSB ?: ($originalSB ?: '-');

        // bentuk 1 baris keterangan untuk scan saat ini
        $line = "{$scanNumber}. {$user} -> Qty : {$newQty} | SB : {$sbDisplay}";
        if ($request->keterangan) {
            $line .= " | Catatan : " . $request->keterangan;
        }

        // gabungkan dengan riwayat lama (jika ada)
        $lines[] = $line;
        $data->keterangan = implode("\n", $lines);

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
        $baru->jenis = $request->jenis ?? 'manual';
        // baris pertama riwayat scan
        $sbDisplayBaru = $request->layout ?: '-';
        $line = "1. " . Auth::user()->name . " -> Qty : " . (int) $request->qty . " | SB : " . $sbDisplayBaru;
        if ($request->keterangan) {
            $line .= " | Catatan : " . $request->keterangan;
        }
        $baru->keterangan = $line;
        $baru->storagebin_hasil = $request->layout;

        $baru->date = \Carbon\Carbon::now();
        $baru->scanner = Auth::user()->name;
        $baru->date_scan = \Carbon\Carbon::now();

        $baru->save();

        return redirect()->back()->with('success', 'Data Manual Telah ditambahkan');

    }

}

    /**
     * Simpan hasil scan / input manual khusus SO KBI.
     */
    public function storeKbi(Request $request)
    {
        $request->validate([
            'attribute'  => 'required|string',
            'qty'        => 'required|numeric',
            'lokasi'     => 'required|string',
            'namabarang' => 'required|string',
        ]);

        $coilNo = $request->attribute;

        // Cari data SO_KBI berdasarkan coil_no
        $data = SO_KBI::where('coil_no', $coilNo)->first();

        if ($data) {
            // Update data hasil scan
            $data->coil_scan   = $coilNo;
            $data->weight_scan = (float) $request->qty;
            $data->storagebin_kbi = $request->lokasi;
            $data->thicknes    = $request->namabarang;
            $data->waktu_scan  = Carbon::now();
            $data->scanner     = Auth::user()->name ?? null;

            // Tambah / update keterangan jika ada input baru
            if ($request->filled('keterangan')) {
                $prefix = $data->keterangan ? $data->keterangan . "\n" : '';
                $data->keterangan = $prefix . $request->keterangan;
            }

            $data->save();
        } else {
            // Jika coil belum ada di tabel SO_KBI, buat entri baru minimal
            SO_KBI::create([
                'date'          => Carbon::now(),
                'coil_no'       => $coilNo,
                'delv_weight'   => (float) $request->qty,
                'storagebin_kbi'=> $request->lokasi,
                'thicknes'      => $request->namabarang,
                'coil_scan'     => $coilNo,
                'weight_scan'   => (float) $request->qty,
                'waktu_scan'    => Carbon::now(),
                'scanner'       => Auth::user()->name ?? null,
                'keterangan'    => $request->keterangan,
            ]);
        }

        return redirect()->back()->with('success', 'Data KBI berhasil disimpan');
    }

    public function sparepart ()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu');
        }

        $data = SAC::where('date', '>=', Carbon::now()->subMonth())
            ->where(function ($q) {
                $q->whereNull('jenis')
                    ->orWhere('jenis', '!=', 'KRAKATAU BAJA INDUSTRI');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('so.index', compact('data'));
    }
    public function kbi ()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu');
        }

        $data = SO_KBI::where('date', '>=', Carbon::now()->subMonth())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('so.kbi', compact('data'));
    }

    public function bahanBaku ()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu');
        }

        $data = SAC::where('date', '>=', Carbon::now()->subMonth())
            ->where('jenis', 'BAHAN BAKU')
            ->orderBy('created_at', 'desc')
            ->get();

        $jenis = 'BAHAN BAKU';
        return view('so.bahan_baku', compact('data', 'jenis'));
    }

    public function barangJadi ()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu');
        }

        $data = SAC::where('date', '>=', Carbon::now()->subMonth())
            ->where('jenis', 'BARANG JADI')
            ->orderBy('created_at', 'desc')
            ->get();

        $jenis = 'BARANG JADI';
        return view('so.barang_jadi', compact('data', 'jenis'));
    }

    public function barangJadiSliting ()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu');
        }

        $data = SAC::where('date', '>=', Carbon::now()->subMonth())
            ->where('jenis', 'BARANG JADI SLITING')
            ->orderBy('created_at', 'desc')
            ->get();

        $jenis = 'BARANG JADI SLITING';
        return view('so.barang_jadi_sliting', compact('data', 'jenis'));
    }

    public function electric ()
    {
        return view('so.cs');
    }

    public function mechanic ()
    {
        return view('so.cs');
    }

    public function proyek ()
    {
        return view('so.cs');
    }

    public function safety ()
    {
        return view('so.cs');
    }

    public function utility ()
    {
        return view('so.cs');
    }

    public function general ()
    {
        return view('so.cs');
    }

}
