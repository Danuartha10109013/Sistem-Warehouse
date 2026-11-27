<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BreakBulk;
use App\Models\PackingList2Item;
use App\Models\ScanKoilEup;
use App\Models\ScanKoilLayout;
use App\Models\ScanKoilPalet;
use App\Models\VerifikasiStiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanKoilEupApiController extends Controller
{
    /**
     * KPI Ringkasan Modul Scan Koil EUP untuk Dashboard Mobile
     */
    public function summary()
    {
        $totalScans = ScanKoilEup::count();
        $totalBerat = (float) ScanKoilEup::sum('berat');
        $totalLayouts = ScanKoilLayout::count();
        $totalPalets = ScanKoilPalet::count();
        $todayScans = ScanKoilEup::whereDate('created_at', today())->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_scans'   => $totalScans,
                'total_berat'   => $totalBerat,
                'total_tonase'  => round($totalBerat / 1000, 2),
                'total_layouts' => $totalLayouts,
                'total_palets'  => $totalPalets,
                'today_scans'   => $todayScans,
            ],
        ]);
    }

    /**
     * Master Data Layout dan Palet untuk Form Input di Mobile
     */
    public function masterOptions()
    {
        $layouts = ScanKoilLayout::orderBy('nama_layout')->get(['id', 'nama_layout']);
        $palets  = ScanKoilPalet::orderBy('nama_palet')->get(['id', 'nama_palet']);

        return response()->json([
            'success' => true,
            'data' => [
                'layouts' => $layouts,
                'palets'  => $palets,
            ],
        ]);
    }

    /**
     * Cek No Coil EUP dan Auto-Lookup Berat dari database gudang
     */
    public function cekCoil($noCoil)
    {
        $cleanCoil = trim($noCoil);

        // 1. Cek apakah sudah pernah discan di ScanKoilEup
        $existing = ScanKoilEup::with(['layout:id,nama_layout', 'palet:id,nama_palet'])
            ->where('no_coil_eup', $cleanCoil)
            ->first();

        // 2. Auto-lookup berat dari referensi gudang lain jika ada
        $berat = 0.0;
        $source = null;

        if ($existing && $existing->berat > 0) {
            $berat = (float) $existing->berat;
            $source = 'Scan Koil EUP';
        }

        if ($berat <= 0) {
            $bb = BreakBulk::where('atribut', $cleanCoil)->first();
            if ($bb && $bb->weight > 0) {
                $berat = (float) $bb->weight;
                $source = 'Katalog Break Bulk';
            }
        }

        if ($berat <= 0) {
            $pl = PackingList2Item::where('attribute', $cleanCoil)->first();
            if ($pl && $pl->quantity > 0) {
                $berat = (float) $pl->quantity;
                $source = 'Packing List 2.0';
            }
        }

        if ($berat <= 0) {
            $vs = VerifikasiStiker::where('attribute', $cleanCoil)->first();
            if ($vs && $vs->berat > 0) {
                $berat = (float) $vs->berat;
                $source = 'Verifikasi Stiker';
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'no_coil_eup' => $cleanCoil,
                'berat'       => $berat > 0 ? $berat : null,
                'source'      => $source,
                'existing'    => $existing,
            ],
        ]);
    }

    /**
     * Mengambil Riwayat Scan Koil EUP
     */
    public function scans(Request $request)
    {
        $query = ScanKoilEup::with(['layout:id,nama_layout', 'palet:id,nama_palet'])
            ->latest();

        if ($request->filled('layout_id')) {
            $query->where('layout_id', $request->layout_id);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where('no_coil_eup', 'like', "%{$search}%");
        }

        if ($request->boolean('all', false)) {
            $data = $query->get();
            return response()->json([
                'success' => true,
                'data'    => $data,
                'total'   => $data->count(),
            ]);
        }

        $perPage = (int) $request->get('per_page', 20);
        $paginated = $query->paginate($perPage);

        return response()->json([
            'success'   => true,
            'data'      => $paginated->items(),
            'total'     => $paginated->total(),
            'has_more'  => $paginated->hasMorePages(),
            'page'      => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
        ]);
    }

    /**
     * Simpan Hasil Scan Koil EUP (Online Direct)
     */
    public function storeScan(Request $request)
    {
        $validated = $request->validate([
            'no_coil_eup' => 'required|string|max:255',
            'layout_id'   => 'required|exists:scan_koil_layouts,id',
            'berat'       => 'required|numeric|min:0.01',
            'palet_id'    => 'nullable|exists:scan_koil_palets,id',
            'keterangan'  => 'nullable|string',
        ]);

        $noCoil = trim($validated['no_coil_eup']);

        // Mencegah duplikasi double click dalam interval 10 detik
        $isDuplicate = ScanKoilEup::where('no_coil_eup', $noCoil)
            ->where('created_at', '>=', now()->subSeconds(10))
            ->exists();

        if ($isDuplicate) {
            return response()->json([
                'success' => false,
                'message' => "Koil {$noCoil} baru saja tersimpan (pencegahan duplikasi).",
            ], 422);
        }

        $scan = ScanKoilEup::create([
            'no_coil_eup' => $noCoil,
            'layout_id'   => $validated['layout_id'],
            'palet_id'    => $validated['palet_id'] ?? null,
            'berat'       => $validated['berat'],
            'keterangan'  => $validated['keterangan'] ?? null,
        ]);

        $scan->load(['layout:id,nama_layout', 'palet:id,nama_palet']);

        return response()->json([
            'success' => true,
            'message' => "Koil {$noCoil} berhasil disimpan.",
            'data'    => $scan,
        ]);
    }

    /**
     * Hapus Data Scan Koil EUP
     */
    public function destroyScan($id)
    {
        $scan = ScanKoilEup::find($id);
        if (!$scan) {
            return response()->json([
                'success' => false,
                'message' => 'Data scan koil tidak ditemukan.',
            ], 404);
        }

        $noCoil = $scan->no_coil_eup;
        $scan->delete();

        return response()->json([
            'success' => true,
            'message' => "Data scan {$noCoil} berhasil dihapus.",
        ]);
    }

    /**
     * Monitoring Tonase per Layout Pengiriman
     */
    public function tonase()
    {
        $tonase = ScanKoilLayout::leftJoin('scan_koil_eups', 'scan_koil_layouts.id', '=', 'scan_koil_eups.layout_id')
            ->select(
                'scan_koil_layouts.id',
                'scan_koil_layouts.nama_layout',
                DB::raw('COALESCE(SUM(scan_koil_eups.berat), 0) as total_berat'),
                DB::raw('COUNT(scan_koil_eups.id) as total_koil')
            )
            ->groupBy('scan_koil_layouts.id', 'scan_koil_layouts.nama_layout')
            ->orderBy('scan_koil_layouts.nama_layout')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $tonase,
        ]);
    }
}
