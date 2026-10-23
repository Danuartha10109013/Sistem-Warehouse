<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PackingList2Batch;
use App\Models\PackingList2Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackingList2ApiController extends Controller
{
    /**
     * Ringkasan statistik untuk dashboard mobile.
     */
    public function getSummary()
    {
        $totalMenunggu = PackingList2Item::where('status', 'MENUNGGU_VALIDASI')->count();
        $totalValid = PackingList2Item::whereIn('status', ['VALID', 'TERVALIDASI'])->count();
        $totalTidakValid = PackingList2Item::where('status', 'TIDAK_VALID')->count();
        $totalTervalidasiHariIni = PackingList2Item::whereIn('status', ['VALID', 'TERVALIDASI', 'TIDAK_VALID'])
            ->whereDate('validated_at', today())
            ->count();
        $totalBatches = PackingList2Batch::count();
        $totalBatchAktif = PackingList2Batch::whereHas('items', function ($q) {
            $q->where('status', 'MENUNGGU_VALIDASI');
        })->count();

        return response()->json([
            'success' => true,
            'status'  => true,
            'data'    => [
                'total_batches'              => $totalBatches,
                'batch_menunggu'             => $totalBatchAktif,
                'total_pending_items'        => $totalMenunggu,
                'menunggu_validasi'          => $totalMenunggu,
                'total_validated_items'      => $totalValid,
                'total_valid'                => $totalValid,
                'total_tidak_valid'          => $totalTidakValid,
                'tervalidasi_hari_ini'       => $totalTervalidasiHariIni,
            ],
        ]);
    }

    /**
     * Daftar batch yang memiliki item untuk divalidasi.
     */
    public function getBatches(Request $request)
    {
        $query = PackingList2Batch::with(['user:id,name'])
            ->withCount([
                'items as total_items',
                'items as count_menunggu' => function ($q) {
                    $q->where('status', 'MENUNGGU_VALIDASI');
                },
                'items as count_tervalidasi' => function ($q) {
                    $q->whereIn('status', ['TERVALIDASI', 'VALID']);
                },
                'items as count_tidak_valid' => function ($q) {
                    $q->where('status', 'TIDAK_VALID');
                },
                'items as count_diperiksa' => function ($q) {
                    $q->whereIn('status', ['TERVALIDASI', 'VALID', 'TIDAK_VALID']);
                }
            ]);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('kode_batch', 'like', "%{$s}%");
        }

        // Filter: hanya batch yang belum selesai jika requested
        if ($request->boolean('only_pending', false)) {
            $query->having('count_menunggu', '>', 0);
        }

        $batches = $query->orderByRaw('DATE(created_at) DESC')
            ->orderByRaw('CASE WHEN no_rit IS NULL THEN 1 ELSE 0 END ASC')
            ->orderByRaw('CAST(no_rit AS UNSIGNED) ASC')
            ->orderBy('kode_batch', 'asc')
            ->get()->map(function ($b) {
            $total = (int) ($b->total_items ?: $b->total_item);
            $valid = (int) $b->count_tervalidasi;
            $tidakValid = (int) $b->count_tidak_valid;
            $diperiksa = (int) $b->count_diperiksa;
            $percent = $total > 0 ? round(($diperiksa / $total) * 100, 1) : 0;
            return [
                'id'                 => $b->id,
                'batch_number'       => $b->kode_batch,
                'kode_batch'         => $b->kode_batch,
                'no_rit'             => $b->no_rit,
                'total_rows'         => $total,
                'total_items'        => $total,
                'validated_count'    => $valid,
                'count_tervalidasi'  => $valid,
                'count_tidak_valid'  => $tidakValid,
                'pending_count'      => (int) $b->count_menunggu,
                'count_menunggu'     => (int) $b->count_menunggu,
                'progress_percent'   => $percent,
                'status'             => ($diperiksa >= $total && $total > 0) ? 'completed' : 'in_progress',
                'original_file_name' => $b->catatan,
                'created_at'         => $b->created_at ? $b->created_at->format('d/m/Y H:i') : null,
                'user'               => $b->user ? ['id' => $b->user->id, 'name' => $b->user->name] : null,
            ];
        });

        return response()->json([
            'success' => true,
            'status'  => true,
            'data'    => $batches,
        ]);
    }

    /**
     * Daftar item dalam batch tertentu.
     */
    public function getBatchItems($id, Request $request)
    {
        $batch = PackingList2Batch::with(['user:id,name'])->find($id);

        if (!$batch) {
            return response()->json([
                'success' => false,
                'message' => 'Batch tidak ditemukan.',
            ], 404);
        }

        $query = PackingList2Item::with(['validator:id,name'])
            ->where('batch_id', $batch->id);

        if ($request->filled('status')) {
            $st = strtoupper($request->status);
            if ($st === 'PENDING' || $st === 'MENUNGGU_VALIDASI' || $st === 'MENUNGGU') {
                $query->where('status', 'MENUNGGU_VALIDASI');
            } elseif ($st === 'VALIDATED' || $st === 'TERVALIDASI' || $st === 'VALID') {
                $query->whereIn('status', ['TERVALIDASI', 'VALID']);
            } elseif ($st === 'TIDAK_VALID' || $st === 'INVALID') {
                $query->where('status', 'TIDAK_VALID');
            } else {
                $query->where('status', $request->status);
            }
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('no_coil', 'like', "%{$s}%")
                  ->orWhere('kode', 'like', "%{$s}%")
                  ->orWhere('nama_produk', 'like', "%{$s}%");
            });
        }

        $items = $query->orderBy('id', 'asc')->get()->map(function ($it) {
            return $this->formatItemForMobile($it);
        });

        return response()->json([
            'success' => true,
            'batch'   => $batch,
            'data'    => $items,
        ]);
    }

    /**
     * Cari koil berdasarkan nomor koil / attribute dari hasil scan barcode/QR.
     */
    public function scanCoil(Request $request)
    {
        $noCoil = trim($request->input('no_coil', $request->input('attribute', '')));

        if (empty($noCoil)) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor koil / attribute tidak boleh kosong.',
            ], 422);
        }

        // Cari item koil (jika ada beberapa koil dengan nomor sama, urutkan dari yang menunggu validasi)
        $item = PackingList2Item::with(['batch:id,kode_batch,created_at', 'validator:id,name'])
            ->where('no_coil', $noCoil)
            ->orderByRaw("FIELD(status, 'MENUNGGU_VALIDASI') DESC")
            ->orderBy('id', 'desc')
            ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => "Attribute '{$noCoil}' tidak ditemukan di sistem Packing List 2.0.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Attribute koil ditemukan.',
            'data'    => $this->formatItemForMobile($item),
        ]);
    }

    /**
     * Format struktur data item koil untuk konsumsi mobile Flutter
     * (Menyediakan metadata checklist hijau: Attribute, Quantity, Length).
     */
    protected function formatItemForMobile(PackingList2Item $item): array
    {
        return [
            'id'             => $item->id,
            'batch_id'       => $item->batch_id,
            'batch_kode'     => $item->batch->kode_batch ?? null,
            'code_product'   => $item->kode,
            'product_name'   => $item->nama_produk,
            'quantity'       => $item->qty,
            'unit'           => $item->uom,
            'attribute'      => $item->no_coil,
            'storagen_bin'   => $item->storage_bin,
            'production'     => $item->tanggal ? $item->tanggal->format('d/m/Y') : null,
            'no_so'          => $item->pengirim,
            'length'         => $item->panjang,
            'time_scan'      => $item->time ? $item->time->format('m/d/Y H:i:s') : null,
            'condition'      => $item->kondisi,
            'loc'            => $item->tujuan,
            'ket'            => $item->keterangan,
            'status'         => ($item->status === 'VALID' || $item->status === 'TERVALIDASI') ? 'valid' : (($item->status === 'TIDAK_VALID') ? 'tidak_valid' : 'pending'),
            'raw_status'     => $item->status,
            'is_validated'   => ($item->status !== 'MENUNGGU_VALIDASI'),
            'is_valid'       => ($item->status === 'VALID' || $item->status === 'TERVALIDASI'),
            'is_tidak_valid' => ($item->status === 'TIDAK_VALID'),
            'checklist_result'   => $item->checklist_result,
            'catatan_verifikasi' => $item->catatan_verifikasi,
            'validated_by'   => $item->validator->name ?? null,
            'validated_at'   => $item->validated_at ? $item->validated_at->format('d/m/Y H:i') : null,

            // Checklist Target Hijau untuk Layar Validasi Flutter
            'validation_checklist' => [
                [
                    'field'          => 'attribute',
                    'label'          => 'Attribute (No Coil)',
                    'expected_value' => $item->no_coil,
                    'is_barcode'     => true,
                ],
                [
                    'field'          => 'quantity',
                    'label'          => 'Quantity',
                    'expected_value' => $item->qty,
                    'unit'           => $item->uom,
                    'is_barcode'     => false,
                ],
                [
                    'field'          => 'length',
                    'label'          => 'Length',
                    'expected_value' => $item->panjang,
                    'unit'           => 'M',
                    'is_barcode'     => false,
                ],
            ],
        ];
    }

    /**
     * Eksekusi validasi satu item koil dari mobile scanner.
     */
    public function validateItem(Request $request, $id)
    {
        $item = PackingList2Item::with(['batch', 'validator:id,name'])->find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data item koil tidak ditemukan.',
            ], 404);
        }

        // Ambil checklist dari request
        $checkAttr = $request->boolean('check_attribute', false);
        $checkQty  = $request->boolean('check_quantity', false);
        $checkLen  = $request->boolean('check_length', false);

        if ($request->has('checklist')) {
            $cl = $request->input('checklist');
            $checkAttr = !empty($cl['attribute']);
            $checkQty  = !empty($cl['quantity']);
            $checkLen  = !empty($cl['length']);
        }

        $allChecked = ($checkAttr && $checkQty && $checkLen);
        $newStatus = $allChecked ? 'VALID' : 'TIDAK_VALID';

        $diffs = [];
        if (!$checkAttr) $diffs[] = 'Attribute';
        if (!$checkQty)  $diffs[] = 'Quantity';
        if (!$checkLen)  $diffs[] = 'Length';

        $catatan = $allChecked
            ? 'Semua atribut sesuai fisik'
            : 'Selisih pada: ' . implode(', ', $diffs);

        // Update status, checklist_result, dan catatan
        $item->status = $newStatus;
        $item->checklist_result = [
            'attribute' => $checkAttr,
            'quantity'  => $checkQty,
            'length'    => $checkLen,
        ];
        $item->catatan_verifikasi = $catatan;
        $item->validated_by = Auth::id();
        $item->validated_at = now();
        $item->save();

        // Muat relasi validator baru
        $item->load(['validator:id,name', 'batch:id,kode_batch']);

        // Catat ke log aktivitas
        \App\Services\LogActivity::record(
            action: 'VERIFIKASI_KOIL',
            module: 'Packing List 2.0 Mobile',
            description: "User " . Auth::user()->name . " memeriksa koil {$item->no_coil} (Hasil: {$newStatus}, {$catatan})"
        );

        $msg = $allChecked
            ? "Koil '{$item->no_coil}' BERHASIL DIVALIDASI (Semua Cocok)."
            : "Koil '{$item->no_coil}' TERVERIFIKASI (TIDAK VALID - {$catatan}).";

        return response()->json([
            'success' => true,
            'status'  => true,
            'message' => $msg,
            'data'    => $this->formatItemForMobile($item),
        ]);
    }

    /**
     * Validasi beberapa item koil sekaligus (bulk validation).
     * Mendukung sinkronisasi offline lengkap dengan payload checklist tiap item.
     */
    public function validateBulk(Request $request)
    {
        $userId = Auth::id();
        $userName = Auth::user()->name ?? 'Operator Mobile';

        // Opsi 1: Payload detail berisi checklist per item (dari offline sync lengkap)
        if ($request->has('items') && is_array($request->input('items'))) {
            $itemsPayload = $request->input('items');
            if (empty($itemsPayload)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tidak ada item dalam antrean sinkronisasi.',
                    'updated_count' => 0,
                ]);
            }

            DB::beginTransaction();
            try {
                $updatedCount = 0;
                $diffItems = [];

                foreach ($itemsPayload as $entry) {
                    $itemId = is_array($entry) ? ($entry['id'] ?? null) : $entry;
                    if (!$itemId) continue;

                    $item = PackingList2Item::find($itemId);
                    if (!$item) continue;

                    $checkAttr = !empty($entry['check_attribute']);
                    $checkQty  = !empty($entry['check_quantity']);
                    $checkLen  = !empty($entry['check_length']);

                    $allChecked = ($checkAttr && $checkQty && $checkLen);
                    $newStatus = $allChecked ? 'VALID' : 'TIDAK_VALID';

                    $diffs = [];
                    if (!$checkAttr) $diffs[] = 'Attribute';
                    if (!$checkQty)  $diffs[] = 'Quantity';
                    if (!$checkLen)  $diffs[] = 'Length';

                    $catatan = $allChecked
                        ? 'Semua atribut sesuai fisik (Offline Sync)'
                        : 'Selisih pada: ' . implode(', ', $diffs) . ' (Offline Sync)';

                    $item->status = $newStatus;
                    $item->checklist_result = [
                        'attribute' => $checkAttr,
                        'quantity'  => $checkQty,
                        'length'    => $checkLen,
                    ];
                    $item->catatan_verifikasi = $catatan;
                    $item->validated_by = $userId;
                    $item->validated_at = !empty($entry['timestamp']) ? \Carbon\Carbon::parse($entry['timestamp']) : now();
                    $item->save();

                    $updatedCount++;
                    if (!$allChecked) {
                        $diffItems[] = $item->no_coil;
                    }
                }

                DB::commit();

                // Catat aktivitas sinkronisasi
                \App\Services\LogActivity::record(
                    action: 'SYNC_OFFLINE_KOIL',
                    module: 'Packing List 2.0 Mobile',
                    description: "User {$userName} menyinkronkan {$updatedCount} item koil dari antrean offline." . (!empty($diffItems) ? " (Selisih: " . count($diffItems) . " koil)" : "")
                );

                return response()->json([
                    'success'         => true,
                    'status'          => true,
                    'message'         => "Berhasil menyinkronkan {$updatedCount} data koil dari memori HP ke server.",
                    'total_validated' => $updatedCount,
                    'updated_count'   => $updatedCount,
                ]);
            } catch (\Throwable $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyinkronkan antrean offline: ' . $e->getMessage(),
                ], 500);
            }
        }

        // Opsi 2: Payload standar item_ids (fallback kompatibilitas lama)
        $request->validate([
            'item_ids' => 'required|array|min:1',
            'item_ids.*' => 'integer',
        ]);

        $ids = $request->input('item_ids');

        DB::beginTransaction();
        try {
            $updatedCount = PackingList2Item::whereIn('id', $ids)
                ->where('status', 'MENUNGGU_VALIDASI')
                ->update([
                    'status'       => 'TERVALIDASI',
                    'validated_by' => $userId,
                    'validated_at' => now(),
                ]);

            DB::commit();

            \App\Services\LogActivity::record(
                action: 'BULK_VALIDASI_KOIL',
                module: 'Packing List 2.0 Mobile',
                description: "User {$userName} memvalidasi massal {$updatedCount} item koil."
            );

            return response()->json([
                'success'         => true,
                'status'          => true,
                'message'         => "Berhasil memvalidasi {$updatedCount} item koil.",
                'total_validated' => $updatedCount,
                'updated_count'   => $updatedCount,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memvalidasi data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
