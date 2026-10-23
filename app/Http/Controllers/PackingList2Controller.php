<?php

namespace App\Http\Controllers;

use App\Exports\PackingList2BatchExport;
use App\Exports\PackingList2LaporanHarianExport;
use App\Models\PackingList2Batch;
use App\Models\PackingList2Item;
use App\Services\PackingList2Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PackingList2Controller extends Controller
{
    protected PackingList2Parser $parser;

    public function __construct(PackingList2Parser $parser)
    {
        $this->parser = $parser;
    }

    // [TAG: HALAMAN UTAMA] Daftar seluruh batch Packing List 2.0 dan ringkasan statistik
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all'); // 'all', 'active', 'completed'

        // Statistik global
        $totalBatch = PackingList2Batch::count();
        $totalItems = PackingList2Item::count();
        $totalMenunggu = PackingList2Item::where('status', 'MENUNGGU_VALIDASI')->count();
        $totalTervalidasi = PackingList2Item::where('status', '!=', 'MENUNGGU_VALIDASI')->count();

        // Hitung jumlah batch aktif vs selesai
        $countActive = PackingList2Batch::whereHas('items', function ($q) {
            $q->where('status', 'MENUNGGU_VALIDASI');
        })->count();

        $countCompleted = PackingList2Batch::whereDoesntHave('items', function ($q) {
            $q->where('status', 'MENUNGGU_VALIDASI');
        })->whereHas('items')->count();

        // [TAG: QUERY BATCH] Ambil riwayat batch dengan hitungan status
        $query = PackingList2Batch::with(['user', 'items'])
            ->withCount([
                'items as total_items_count',
                'items as count_menunggu' => function ($q) {
                    $q->where('status', 'MENUNGGU_VALIDASI');
                },
                'items as count_valid' => function ($q) {
                    $q->whereIn('status', ['TERVALIDASI', 'VALID']);
                },
                'items as count_tidak_valid' => function ($q) {
                    $q->where('status', 'TIDAK_VALID');
                },
                'items as count_tervalidasi' => function ($q) {
                    $q->where('status', '!=', 'MENUNGGU_VALIDASI');
                }
            ]);

        // Filter tab: default menampilkan yang masih butuh pemeriksaan (active)
        if ($tab === 'active') {
            $query->having('count_menunggu', '>', 0);
        } elseif ($tab === 'completed') {
            $query->having('count_menunggu', '=', 0);
        }

        $batches = $query->orderByRaw('DATE(created_at) DESC')
            ->orderByRaw('CASE WHEN no_rit IS NULL THEN 1 ELSE 0 END ASC')
            ->orderByRaw('CAST(no_rit AS UNSIGNED) ASC')
            ->orderBy('kode_batch', 'asc')
            ->get();

        return view('packing_list_2.dashboard.index', compact(
            'totalBatch',
            'totalItems',
            'totalMenunggu',
            'totalTervalidasi',
            'batches',
            'tab',
            'countActive',
            'countCompleted'
        ));
    }

    // [TAG: FORM TEMPEL EXCEL] Halaman untuk menempelkan data copy-paste dari Excel
    public function paste()
    {
        return view('packing_list_2.dashboard.paste');
    }

    // [TAG: PREVIEW PARSER] Mengurai teks tempelan TSV dan mengembalikan hasil validasi JSON
    public function parsePreview(Request $request)
    {
        $request->validate([
            'raw_text' => 'required|string',
        ]);

        $rawText = $request->input('raw_text');
        $result = $this->parser->parse($rawText);

        return response()->json($result);
    }

    // [TAG: SIMPAN BATCH & ITEM] Validasi ulang sisi server dan simpan dalam 1 transaksi DB
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'catatan' => 'nullable|string|max:500',
        ]);

        $itemsInput = $request->input('items');
        $catatan = $request->input('catatan');

        // [TAG: VALIDASI ULANG SERVER-SIDE] Re-validasi independen setiap baris
        $errors = [];
        $validatedRows = [];
        foreach ($itemsInput as $idx => $row) {
            $rowNum = $idx + 1;
            $rowErrors = [];

            $kode        = trim($row['kode'] ?? '');
            $namaProduk  = trim($row['nama_produk'] ?? '');
            $rawQty      = $row['qty'] ?? null;
            $uom         = trim($row['uom'] ?? '');
            $noCoil      = trim($row['no_coil'] ?? '');
            $storageBin  = trim($row['storage_bin'] ?? '');
            $rawTanggal  = trim($row['tanggal'] ?? '');
            $pengirim    = trim($row['pengirim'] ?? '');
            $rawPanjang  = $row['panjang'] ?? null;
            $rawTime     = trim($row['time'] ?? '');
            $kondisi     = trim($row['kondisi'] ?? '');
            $tujuan      = trim($row['tujuan'] ?? '');
            $keterangan  = trim($row['keterangan'] ?? '');

            if (empty($kode)) $rowErrors[] = "KODE baris {$rowNum} kosong.";
            if (empty($namaProduk)) $rowErrors[] = "NAMA PRODUK baris {$rowNum} kosong.";

            $cleanQty = $this->parser->parseNumber((string) $rawQty);
            if ($cleanQty === null || $cleanQty <= 0) {
                $rowErrors[] = "QTY baris {$rowNum} tidak valid (harus > 0).";
            }

            if (empty($uom)) $rowErrors[] = "UOM baris {$rowNum} kosong.";

            // NO COIL wajib diisi, duplikat diperbolehkan
            if (empty($noCoil)) {
                $rowErrors[] = "NO COIL baris {$rowNum} kosong.";
            }

            // Tanggal bisa format Y-m-d atau d/m/Y
            $dtTanggal = null;
            if (!empty($rawTanggal)) {
                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $rawTanggal)) {
                    $dtTanggal = $rawTanggal;
                } else {
                    $parsedDt = $this->parser->parseTanggal($rawTanggal);
                    $dtTanggal = $parsedDt ? $parsedDt->format('Y-m-d') : null;
                }
            }
            if (!$dtTanggal) {
                $rowErrors[] = "TANGGAL baris {$rowNum} tidak valid.";
            }

            $cleanPanjang = $this->parser->parseNumber((string) $rawPanjang);
            if ($cleanPanjang === null || $cleanPanjang <= 0) {
                $rowErrors[] = "PANJANG baris {$rowNum} tidak valid (harus > 0).";
            }

            // Time bisa format Y-m-d H:i:s atau mm/dd/yyyy hh:mm:ss
            $dtTime = null;
            if (!empty($rawTime)) {
                if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $rawTime)) {
                    $dtTime = $rawTime;
                } else {
                    $parsedTime = $this->parser->parseTime($rawTime);
                    $dtTime = $parsedTime ? $parsedTime->format('Y-m-d H:i:s') : null;
                }
            }
            if (!$dtTime) {
                $rowErrors[] = "TIME baris {$rowNum} tidak valid.";
            }

            if (empty($kondisi)) $rowErrors[] = "KONDISI baris {$rowNum} kosong.";
            if (empty($tujuan)) $rowErrors[] = "TUJUAN baris {$rowNum} kosong.";

            if (count($rowErrors) > 0) {
                $errors = array_merge($errors, $rowErrors);
            } else {
                $validatedRows[] = [
                    'kode'        => $kode,
                    'nama_produk' => $namaProduk,
                    'qty'         => $cleanQty,
                    'uom'         => $uom,
                    'no_coil'     => $noCoil,
                    'storage_bin' => $storageBin,
                    'tanggal'     => $dtTanggal,
                    'pengirim'    => $pengirim,
                    'panjang'     => $cleanPanjang,
                    'time'        => $dtTime,
                    'kondisi'     => $kondisi,
                    'tujuan'      => $tujuan,
                    'keterangan'  => $keterangan,
                    'status'      => 'MENUNGGU_VALIDASI',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }

        if (count($errors) > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Terdapat kesalahan data saat validasi server.',
                'errors' => $errors,
            ], 422);
        }

        // [TAG: PENGELOMPOKAN RIT] Kelompokkan baris berdasarkan nomor rit dari kolom keterangan
        $groupedByRit = [];
        foreach ($validatedRows as $row) {
            $rit = $this->parser->extractRitNumber($row['keterangan'] ?? null);
            $key = $rit !== null ? "RIT_{$rit}" : 'TANPA_RIT';
            if (!isset($groupedByRit[$key])) {
                $groupedByRit[$key] = [
                    'rit'   => $rit,
                    'items' => [],
                ];
            }
            $groupedByRit[$key]['items'][] = $row;
        }

        // [TAG: TRANSAKSI DATABASE] Simpan batch per rit secara atomik
        DB::beginTransaction();
        try {
            $dateStr = date('Ymd');
            $createdBatches = [];

            foreach ($groupedByRit as $group) {
                $rit = $group['rit'];
                $items = $group['items'];
                $countItems = count($items);

                // Buat kode batch berbasis tanggal dan rit
                if ($rit !== null) {
                    $padRit = str_pad($rit, 2, '0', STR_PAD_LEFT);
                    $baseCode = "BATCH-{$dateStr}-RIT{$padRit}";
                    $kodeBatch = $baseCode;

                    // Jika di hari yang sama sudah ada batch rit ini, tambah suffix angka
                    $counter = 2;
                    while (PackingList2Batch::where('kode_batch', $kodeBatch)->exists()) {
                        $kodeBatch = "{$baseCode}-{$counter}";
                        $counter++;
                    }
                    $catatanBatch = $catatan ? "{$catatan} (Rit {$rit})" : "Rit {$rit}";
                } else {
                    $prefix = "BATCH-{$dateStr}";
                    $latestBatch = PackingList2Batch::where('kode_batch', 'like', "{$prefix}-%")->latest('id')->first();
                    $nextSeq = 1;
                    if ($latestBatch) {
                        $parts = explode('-', $latestBatch->kode_batch);
                        $lastNum = (int) end($parts);
                        $nextSeq = $lastNum + 1;
                    }
                    $kodeBatch = sprintf('%s-%04d', $prefix, $nextSeq);
                    $catatanBatch = $catatan;
                }

                $batch = PackingList2Batch::create([
                    'kode_batch' => $kodeBatch,
                    'no_rit'     => $rit,
                    'user_id'    => Auth::id(),
                    'total_item' => $countItems,
                    'catatan'    => $catatanBatch,
                ]);

                // Assign batch_id ke setiap baris dalam grup ini
                foreach ($items as &$item) {
                    $item['batch_id'] = $batch->id;
                }
                unset($item);

                // Bulk insert item
                PackingList2Item::insert($items);

                $createdBatches[] = [
                    'id'         => $batch->id,
                    'kode_batch' => $kodeBatch,
                    'no_rit'     => $rit,
                    'total_item' => $countItems,
                ];
            }

            DB::commit();

            $batchCount = count($createdBatches);
            if ($batchCount === 1) {
                $first = $createdBatches[0];
                $ritText = $first['no_rit'] ? " (Rit {$first['no_rit']})" : "";
                return response()->json([
                    'success'     => true,
                    'batch_count' => 1,
                    'message'     => "Berhasil menyimpan batch {$first['kode_batch']}{$ritText} dengan {$first['total_item']} item.",
                    'batch_id'    => $first['id'],
                    'kode_batch'  => $first['kode_batch'],
                    'redirect'    => route('packing-list-2.detail', $first['id']),
                ]);
            } else {
                $names = implode(', ', array_map(function ($b) {
                    return $b['kode_batch'] . ($b['no_rit'] ? " (Rit {$b['no_rit']})" : "");
                }, $createdBatches));
                return response()->json([
                    'success'     => true,
                    'batch_count' => $batchCount,
                    'message'     => "Berhasil menyimpan {$batchCount} batch terpisah: {$names}.",
                    'batches'     => $createdBatches,
                    'redirect'    => route('packing-list-2.dashboard'),
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan ke database: ' . $e->getMessage(),
            ], 500);
        }
    }

    // [TAG: DETAIL BATCH] Monitoring data batch: tabel item koil, pencarian & filter status
    public function detail($id, Request $request)
    {
        $batch = PackingList2Batch::with(['user'])->findOrFail($id);

        $query = PackingList2Item::where('batch_id', $batch->id);

        // Filter status jika ada
        if ($request->filled('status')) {
            $st = $request->status;
            if ($st === 'VALID' || $st === 'TERVALIDASI') {
                $query->whereIn('status', ['VALID', 'TERVALIDASI']);
            } else {
                $query->where('status', $st);
            }
        }

        // Pencarian NO COIL atau KODE
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_coil', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%")
                  ->orWhere('nama_produk', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('id', 'asc')->get();

        // Ringkasan status item batch ini
        $summary = [
            'total'       => $batch->items()->count(),
            'menunggu'    => $batch->items()->where('status', 'MENUNGGU_VALIDASI')->count(),
            'valid'       => $batch->items()->whereIn('status', ['VALID', 'TERVALIDASI'])->count(),
            'tidak_valid' => $batch->items()->where('status', 'TIDAK_VALID')->count(),
            'tervalidasi' => $batch->items()->where('status', '!=', 'MENUNGGU_VALIDASI')->count(),
        ];

        return view('packing_list_2.dashboard.detail', compact('batch', 'items', 'summary'));
    }

    // [TAG: HAPUS BATCH] Hapus batch beserta seluruh data koil di dalamnya
    public function destroyBatch($id)
    {
        $batch = PackingList2Batch::with('items')->findOrFail($id);
        $kodeBatch = $batch->kode_batch;

        DB::beginTransaction();
        try {
            // Hapus semua item koil di dalam batch ini
            $batch->items()->delete();
            $batch->delete();

            // Catat log aktivitas
            \App\Services\LogActivity::record(
                action: 'HAPUS_BATCH',
                module: 'Packing List 2.0',
                description: "User " . (Auth::user()->name ?? 'Admin') . " menghapus batch {$kodeBatch} beserta seluruh item koilnya."
            );

            DB::commit();
            return redirect()->route('packing-list-2.dashboard')->with('success', "Batch {$kodeBatch} beserta seluruh datanya berhasil dihapus permanen.");
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus batch: ' . $e->getMessage());
        }
    }

    // [TAG: EXPORT EXCEL BATCH] Download seluruh item koil batch ke file Excel
    public function exportExcel($id, Request $request)
    {
        $batch = PackingList2Batch::with(['user'])->findOrFail($id);

        $query = PackingList2Item::with(['validator'])->where('batch_id', $batch->id);

        // Filter status jika ada
        if ($request->filled('status')) {
            $st = $request->status;
            if ($st === 'VALID' || $st === 'TERVALIDASI') {
                $query->whereIn('status', ['VALID', 'TERVALIDASI']);
            } else {
                $query->where('status', $st);
            }
        }

        // Pencarian NO COIL atau KODE
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_coil', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%")
                  ->orWhere('nama_produk', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('id', 'asc')->get();

        $safeCode = preg_replace('/[^A-Za-z0-9_-]/', '_', $batch->kode_batch);
        $fileName = 'Daftar_Item_Koil_' . $safeCode . '_' . date('Ymd_His') . '.xlsx';

        return Excel::download(new PackingList2BatchExport($batch, $items), $fileName);
    }

    // [TAG: LAPORAN HARIAN BATCH] Halaman laporan dan riwayat batch per hari
    public function laporanHarian(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));

        // Query batch pada tanggal yang dipilih
        $batches = PackingList2Batch::with(['user', 'items.validator'])
            ->whereDate('created_at', $tanggal)
            ->orderBy('id', 'asc')
            ->get();

        // Hitung statistik hari ini
        $totalBatch = $batches->count();
        $totalItems = 0;
        $totalValid = 0;
        $totalPending = 0;
        $totalSelisih = 0;

        foreach ($batches as $b) {
            $totalItems += $b->items->count();
            $totalValid += $b->items->whereIn('status', ['VALID', 'TERVALIDASI'])->count();
            $totalPending += $b->items->where('status', 'MENUNGGU_VALIDASI')->count();
            $totalSelisih += $b->items->where('status', 'TIDAK_VALID')->count();
        }

        $summary = [
            'total_batch' => $totalBatch,
            'total_items' => $totalItems,
            'valid'       => $totalValid,
            'menunggu'    => $totalPending,
            'tidak_valid' => $totalSelisih,
        ];

        // Daftar tanggal terbaru yang memiliki batch untuk tombol cepat
        $availableDates = PackingList2Batch::selectRaw('DATE(created_at) as tgl, COUNT(*) as jml_batch')
            ->groupBy('tgl')
            ->orderBy('tgl', 'desc')
            ->limit(7)
            ->get();

        return view('packing_list_2.laporan.index', compact('batches', 'tanggal', 'summary', 'availableDates'));
    }

    // [TAG: EXPORT EXCEL LAPORAN HARIAN] Download seluruh batch dan koil tanggal terpilih
    public function exportLaporanHarian(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));

        $batches = PackingList2Batch::with(['user', 'items.validator'])
            ->whereDate('created_at', $tanggal)
            ->orderBy('id', 'asc')
            ->get();

        $totalItems = 0;
        $totalValid = 0;
        $totalPending = 0;
        $totalSelisih = 0;

        foreach ($batches as $b) {
            $totalItems += $b->items->count();
            $totalValid += $b->items->whereIn('status', ['VALID', 'TERVALIDASI'])->count();
            $totalPending += $b->items->where('status', 'MENUNGGU_VALIDASI')->count();
            $totalSelisih += $b->items->where('status', 'TIDAK_VALID')->count();
        }

        $summary = [
            'total_batch' => $batches->count(),
            'total_items' => $totalItems,
            'valid'       => $totalValid,
            'menunggu'    => $totalPending,
            'tidak_valid' => $totalSelisih,
        ];

        $dateStr = str_replace('-', '', $tanggal);
        $fileName = 'Laporan_Batch_Harian_' . $dateStr . '_' . date('His') . '.xlsx';

        return Excel::download(new PackingList2LaporanHarianExport($tanggal, $batches, $summary), $fileName);
    }
}
