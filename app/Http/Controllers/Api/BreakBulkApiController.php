<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BreakBulk;
use App\Models\BreakBulkMaster;
use App\Models\BreakBulkScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BreakBulkApiController extends Controller
{
    /**
     * KPI Ringkasan Setting Break Bulk untuk Dashboard Mobile
     */
    public function summary()
    {
        $totalScans = BreakBulkScan::count();
        $totalWeight = (float) BreakBulkScan::leftJoin('break_bulks', 'break_bulk_scans.atribut', '=', 'break_bulks.atribut')
            ->selectRaw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0) as effective_weight')
            ->sum(DB::raw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0)'));

        $totalTrailers = BreakBulkScan::distinct('trailer')->count('trailer');
        $totalCatalog = BreakBulk::count();
        $totalPending = BreakBulk::where('status', 'pending')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_scans'    => $totalScans,
                'total_weight'   => $totalWeight,
                'total_trailers' => $totalTrailers,
                'total_catalog'  => $totalCatalog,
                'total_pending'  => $totalPending,
            ],
        ]);
    }

    /**
     * Mengambil Master Options (Grouping, POD, Lokasi) untuk form input di Mobile
     */
    public function masterOptions()
    {
        $grouping = BreakBulkMaster::where('kategori', 'grouping')->orderBy('nama')->pluck('nama');
        $pod      = BreakBulkMaster::where('kategori', 'pod')->orderBy('nama')->pluck('nama');
        $lokasi   = BreakBulkMaster::where('kategori', 'lokasi')->orderBy('nama')->pluck('nama');

        // Jika master masih kosong di database, berikan fallback default
        if ($grouping->isEmpty()) {
            $grouping = collect(['CR NON OIL', 'CR OIL', 'GI', 'GL']);
        }
        if ($pod->isEmpty()) {
            $pod = collect(['HOUSTON', 'CHARLESTON', 'TAMPA', 'NEW ORLEANS']);
        }
        if ($lokasi->isEmpty()) {
            $lokasi = collect(['TB-1', 'TB-2', 'TB-3', 'WH-A']);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'grouping' => $grouping,
                'pod'      => $pod,
                'lokasi'   => $lokasi,
            ],
        ]);
    }

    /**
     * Download seluruh katalog koil Break Bulk untuk offline caching di HP
     */
    public function catalog(Request $request)
    {
        $query = BreakBulk::select('id', 'atribut', 'weight', 'product', 'no_so', 'status', 'scanned_at', 'scanned_by')
            ->orderBy('id', 'desc');

        if ($request->boolean('all', true)) {
            $items = $query->get();
            return response()->json([
                'success' => true,
                'data'    => $items,
                'total'   => $items->count(),
            ]);
        }

        $items = $query->paginate(50);
        return response()->json([
            'success' => true,
            'data'    => $items->items(),
            'total'   => $items->total(),
            'has_more'=> $items->hasMorePages(),
        ]);
    }

    /**
     * Cek atribut secara online (dan cek apakah sudah ada scan sebelumnya)
     */
    public function cekAtribut($atribut)
    {
        $cleanAttr = trim($atribut);
        $item = BreakBulk::where('atribut', $cleanAttr)->first();
        $existingScan = BreakBulkScan::where('atribut', $cleanAttr)->first();

        $scanData = null;
        if ($existingScan) {
            $scanData = [
                'id'       => $existingScan->id,
                'trailer'  => $existingScan->trailer,
                'grouping' => $existingScan->grouping,
                'pod'      => $existingScan->pod,
                'lokasi'   => $existingScan->lokasi,
                'no_so'    => $existingScan->no_so,
                'weight'   => (float)$existingScan->weight,
                'product'  => $existingScan->product,
            ];
        }

        if ($item) {
            return response()->json([
                'success'         => true,
                'exists'          => true,
                'already_scanned' => (bool)$existingScan,
                'existing_scan'   => $scanData,
                'data'            => [
                    'id'      => $item->id,
                    'atribut' => $item->atribut,
                    'weight'  => (float)$item->weight,
                    'product' => $item->product,
                    'no_so'   => $item->no_so,
                    'status'  => $item->status,
                ],
            ]);
        }

        return response()->json([
            'success'         => true,
            'exists'          => false,
            'already_scanned' => (bool)$existingScan,
            'existing_scan'   => $scanData,
            'data'            => [
                'atribut' => $cleanAttr,
                'weight'  => $existingScan ? (float)$existingScan->weight : 0,
                'product' => $existingScan ? $existingScan->product : 'Menunggu Import',
                'no_so'   => $existingScan ? $existingScan->no_so : null,
                'status'  => 'pending',
            ],
            'message'         => 'Atribut belum terdaftar di Tambah Data (tetap bisa discan & disimpan).',
        ]);
    }

    /**
     * Simpan / Update Hasil Scan Operator secara langsung (Online mode)
     */
    public function storeScan(Request $request)
    {
        $request->validate([
            'atribut'  => 'required|string',
            'trailer'  => 'required|string',
            'weight'   => 'nullable|numeric',
            'product'  => 'nullable|string',
            'grouping' => 'required|string',
            'pod'      => 'required|string',
            'lokasi'   => 'required|string',
            'no_so'    => 'nullable|string',
        ]);

        $cleanAttr = trim($request->atribut);
        $breakBulkItem = BreakBulk::where('atribut', $cleanAttr)->first();

        $weight = $breakBulkItem && $breakBulkItem->weight > 0
            ? (float)$breakBulkItem->weight
            : ($request->filled('weight') ? (float)$request->weight : 0);

        $product = $breakBulkItem && $breakBulkItem->product !== '-'
            ? $breakBulkItem->product
            : ($request->filled('product') ? trim($request->product) : 'Menunggu Import');

        $noSo = !empty($request->no_so)
            ? strtoupper(trim($request->no_so))
            : ($breakBulkItem ? $breakBulkItem->no_so : null);

        $existingScan = BreakBulkScan::where('atribut', $cleanAttr)->first();
        $userName = Auth::check() ? Auth::user()->name : 'Mobile Operator';

        if ($existingScan) {
            $existingScan->update([
                'trailer'    => trim($request->trailer),
                'weight'     => $weight > 0 ? $weight : $existingScan->weight,
                'product'    => ($product && $product !== 'Menunggu Import') ? $product : $existingScan->product,
                'grouping'   => trim($request->grouping),
                'pod'        => strtoupper(trim($request->pod)),
                'no_so'      => $noSo ?: $existingScan->no_so,
                'lokasi'     => strtoupper(trim($request->lokasi)),
                'scanned_by' => $userName,
                'scanned_at' => now(),
            ]);

            if ($breakBulkItem) {
                $breakBulkItem->update([
                    'status'     => 'scanned',
                    'scanned_at' => now(),
                    'scanned_by' => Auth::id(),
                    'no_so'      => $noSo ?: $breakBulkItem->no_so,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => "Data scan atribut {$cleanAttr} berhasil diperbarui ke Trailer {$request->trailer}.",
                'data'    => $existingScan,
            ]);
        }

        $scan = BreakBulkScan::create([
            'atribut'    => $cleanAttr,
            'trailer'    => trim($request->trailer),
            'weight'     => $weight,
            'product'    => $product ?: 'Menunggu Import',
            'grouping'   => trim($request->grouping),
            'pod'        => strtoupper(trim($request->pod)),
            'no_so'      => $noSo,
            'lokasi'     => strtoupper(trim($request->lokasi)),
            'scanned_by' => $userName,
            'scanned_at' => now(),
        ]);

        if ($breakBulkItem) {
            $breakBulkItem->update([
                'status'     => 'scanned',
                'scanned_at' => now(),
                'scanned_by' => Auth::id(),
                'no_so'      => $noSo ?: $breakBulkItem->no_so,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Atribut {$cleanAttr} berhasil disimpan ke Trailer {$request->trailer}.",
            'data'    => $scan,
        ]);
    }

    /**
     * List Hasil Scan
     */
    public function scans(Request $request)
    {
        $query = BreakBulkScan::leftJoin('break_bulks', 'break_bulk_scans.atribut', '=', 'break_bulks.atribut')
            ->select(
                'break_bulk_scans.id',
                'break_bulk_scans.atribut',
                'break_bulk_scans.trailer',
                DB::raw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0) as weight'),
                DB::raw('COALESCE(NULLIF(break_bulks.product, "-"), NULLIF(break_bulk_scans.product, "-"), "Menunggu Import") as product'),
                DB::raw('COALESCE(break_bulk_scans.no_so, break_bulks.no_so) as no_so'),
                'break_bulk_scans.grouping',
                'break_bulk_scans.pod',
                'break_bulk_scans.lokasi',
                'break_bulk_scans.scanned_by',
                'break_bulk_scans.scanned_at',
                'break_bulk_scans.created_at'
            )
            ->orderBy('break_bulk_scans.id', 'desc');

        if ($request->filled('trailer')) {
            $query->where('break_bulk_scans.trailer', $request->trailer);
        }

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('break_bulk_scans.atribut', 'like', "%{$q}%")
                    ->orWhere('break_bulk_scans.trailer', 'like', "%{$q}%")
                    ->orWhere('break_bulk_scans.no_so', 'like', "%{$q}%");
            });
        }

        $scans = $query->get();

        return response()->json([
            'success' => true,
            'data'    => $scans,
            'total'   => $scans->count(),
        ]);
    }

    /**
     * Hapus 1 Baris Scan
     */
    public function destroyScan($id)
    {
        $scan = BreakBulkScan::findOrFail($id);
        $attr = $scan->atribut;

        BreakBulk::where('atribut', $attr)->update([
            'status'     => 'pending',
            'scanned_at' => null,
            'scanned_by' => null,
        ]);

        $scan->delete();

        return response()->json([
            'success' => true,
            'message' => "Data scan atribut {$attr} berhasil dihapus.",
        ]);
    }

    /**
     * Monitoring Tonase per Trailer
     */
    public function tonase()
    {
        $scans = BreakBulkScan::leftJoin('break_bulks', 'break_bulk_scans.atribut', '=', 'break_bulks.atribut')
            ->select(
                'break_bulk_scans.id',
                'break_bulk_scans.atribut',
                'break_bulk_scans.trailer',
                DB::raw('COALESCE(NULLIF(break_bulks.weight, 0), break_bulk_scans.weight, 0) as weight'),
                DB::raw('COALESCE(NULLIF(break_bulks.product, "-"), NULLIF(break_bulk_scans.product, "-"), "Menunggu Import") as product'),
                DB::raw('COALESCE(break_bulk_scans.no_so, break_bulks.no_so) as no_so'),
                'break_bulk_scans.grouping',
                'break_bulk_scans.pod',
                'break_bulk_scans.lokasi',
                'break_bulk_scans.scanned_by',
                'break_bulk_scans.scanned_at'
            )
            ->get();

        $grouped = $scans->groupBy('trailer');
        $trailers = $grouped->map(function ($items, $trailerNo) {
            return [
                'trailer'      => (string) $trailerNo,
                'total_koil'   => $items->count(),
                'total_weight' => (float) $items->sum('weight'),
                'pods'         => $items->pluck('pod')->filter()->unique()->values()->all(),
                'groupings'    => $items->pluck('grouping')->filter()->unique()->values()->all(),
                'lokasis'      => $items->pluck('lokasi')->filter()->unique()->values()->all(),
                'items'        => $items->values()->all(),
            ];
        })->sortBy('trailer')->values();

        return response()->json([
            'success' => true,
            'data' => [
                'trailers'           => $trailers,
                'total_trailer'      => $trailers->count(),
                'total_koil'         => $scans->count(),
                'grand_total_weight' => (float) $scans->sum('weight'),
            ],
        ]);
    }
}
