<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\KapasitasHistory;

class KelolaKapasitasController extends Controller
{
    /**
     * Menampilkan halaman kelola kapasitas
     */
    public function index(Request $request)
    {
        // Ambil filter bulan dan tahun (default ke bulan/tahun saat ini jika tidak ada)
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Cari di riwayat untuk bulan dan tahun yang dipilih
        $history = KapasitasHistory::where('bulan', $bulan)->where('tahun', $tahun)->first();

        if ($history) {
            $kapasitasCrc = $history->kapasitas_crc;
            $kapasitasBarangJadi = $history->kapasitas_barang_jadi;
        } else {
            // Cari history terdekat sebelumnya
            $lastHistory = KapasitasHistory::where(function($q) use ($bulan, $tahun) {
                $q->where('tahun', '<', $tahun)
                  ->orWhere(function($sq) use ($bulan, $tahun) {
                      $sq->where('tahun', $tahun)->where('bulan', '<', $bulan);
                  });
            })->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->first();

            if ($lastHistory) {
                $kapasitasCrc = $lastHistory->kapasitas_crc;
                $kapasitasBarangJadi = $lastHistory->kapasitas_barang_jadi;
            } else {
                // Fallback ke setting jika belum di-set sama sekali
                $kapasitasCrcSetting = Setting::where('key', 'kapasitas_crc')->first();
                $kapasitasCrc = $kapasitasCrcSetting ? $kapasitasCrcSetting->value : '6760';

                $kapasitasBjSetting = Setting::where('key', 'kapasitas_barang_jadi')->first();
                $kapasitasBarangJadi = $kapasitasBjSetting ? $kapasitasBjSetting->value : '12000';
            }
        }

        // Ambil daftar riwayat untuk ditampilkan di tabel
        $histories = KapasitasHistory::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();

        return view('modul_kapasitas.kelola.V_kapasitas', compact('kapasitasCrc', 'kapasitasBarangJadi', 'bulan', 'tahun', 'histories'));
    }

    /**
     * Menyimpan atau mengupdate nilai kapasitas
     */
    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'kapasitas_crc' => 'required|numeric',
            'kapasitas_barang_jadi' => 'required|numeric'
        ]);

        // Update atau create riwayat per bulan yang dipilih
        KapasitasHistory::updateOrCreate(
            ['bulan' => $request->bulan, 'tahun' => $request->tahun],
            [
                'kapasitas_crc' => $request->kapasitas_crc,
                'kapasitas_barang_jadi' => $request->kapasitas_barang_jadi
            ]
        );

        // Update riwayat bulan-bulan berikutnya (masa depan) agar ikut berubah
        KapasitasHistory::where(function($query) use ($request) {
            $query->where('tahun', '>', $request->tahun)
                  ->orWhere(function($q) use ($request) {
                      $q->where('tahun', $request->tahun)->where('bulan', '>', $request->bulan);
                  });
        })->update([
            'kapasitas_crc' => $request->kapasitas_crc,
            'kapasitas_barang_jadi' => $request->kapasitas_barang_jadi
        ]);

        return redirect()->route('modul-kapasitas.kelola-kapasitas', ['bulan' => $request->bulan, 'tahun' => $request->tahun])->with('success', 'Nilai kapasitas berhasil diperbarui.');
    }
}
