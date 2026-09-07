<?php

namespace App\Http\Controllers;

use App\Models\VerifikasiTimbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiTimbanganController extends Controller
{
    public function index()
    {
        $data = VerifikasiTimbangan::orderBy('tanggal', 'asc')->paginate(15);
        return view('verifikasi_timbangan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'actual' => 'required|numeric'
        ]);

        // Berat label ditetapkan paten 9340
        $label = 9340;

        // Perhitungan selisih: actual dikurangi label
        $selisih = $request->actual - $label;

        // Toleransi -10 sampai 10
        if ($selisih < -10 || $selisih > 10) {
            $status = 'NOT OK';
        } else {
            $status = 'OK';
        }

        VerifikasiTimbangan::create([
            'tanggal' => $request->tanggal,
            'label' => $label,
            'actual' => $request->actual,
            'selisih' => $selisih,
            'status' => $status,
            'operator_name' => Auth::check() ? Auth::user()->name : 'Guest',
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tindak_lanjut' => 'required|string',
            'actual_setelah' => 'required|numeric',
        ]);

        $timbangan = VerifikasiTimbangan::findOrFail($id);

        $selisih_setelah = $request->actual_setelah - $timbangan->label;

        $timbangan->update([
            'tindak_lanjut' => $request->tindak_lanjut,
            'actual_setelah' => $request->actual_setelah,
            'selisih_setelah' => $selisih_setelah,
            'status' => 'OK' // Asumsi setelah kalibrasi status jadi OK
        ]);

        return redirect()->back()->with('success', 'Tindak lanjut kalibrasi berhasil disimpan!');
    }

    public function destroy($id)
    {
        $timbangan = VerifikasiTimbangan::findOrFail($id);
        $timbangan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
