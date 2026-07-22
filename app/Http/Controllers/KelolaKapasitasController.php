<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class KelolaKapasitasController extends Controller
{
    /**
     * Menampilkan halaman kelola kapasitas
     */
    public function index()
    {
        // Ambil nilai kapasitas CRC dari setting (default 6760)
        $kapasitasCrcSetting = Setting::where('key', 'kapasitas_crc')->first();
        $kapasitasCrc = $kapasitasCrcSetting ? $kapasitasCrcSetting->value : '6760';

        // Ambil nilai kapasitas Barang Jadi dari setting (default 10000)
        $kapasitasBjSetting = Setting::where('key', 'kapasitas_barang_jadi')->first();
        $kapasitasBarangJadi = $kapasitasBjSetting ? $kapasitasBjSetting->value : '10000';

        return view('modul_kapasitas.kelola.V_kapasitas', compact('kapasitasCrc', 'kapasitasBarangJadi'));
    }

    /**
     * Menyimpan atau mengupdate nilai kapasitas
     */
    public function store(Request $request)
    {
        $request->validate([
            'kapasitas_crc' => 'required|numeric',
            'kapasitas_barang_jadi' => 'required|numeric'
        ]);

        // Update atau buat (jika belum ada) setting kapasitas_crc
        Setting::updateOrCreate(
            ['key' => 'kapasitas_crc'],
            ['value' => $request->kapasitas_crc]
        );

        // Update atau buat (jika belum ada) setting kapasitas_barang_jadi
        Setting::updateOrCreate(
            ['key' => 'kapasitas_barang_jadi'],
            ['value' => $request->kapasitas_barang_jadi]
        );

        return redirect()->route('modul-kapasitas.kelola-kapasitas')->with('success', 'Nilai kapasitas berhasil diperbarui.');
    }
}
