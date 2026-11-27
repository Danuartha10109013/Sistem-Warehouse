<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SAC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOpnameApiController extends Controller
{
    private const CATEGORIES = [
        'sparepart' => 'SPAREPART',
        'bahan_baku' => 'BB - BJ - BJS - SP',
    ];

    public function summary(Request $request)
    {
        $category = $request->string('category', 'sparepart')->toString();
        $query = $this->queryForCategory($category);

        $total = (clone $query)->count();
        $scanned = (clone $query)->whereNotNull('qty_scan')->where('qty_scan', '>', 0)->count();
        $remaining = (clone $query)->get()->sum(function ($row) {
            return max((float) ($row->berat ?? 0) - (float) ($row->qty_scan ?? 0), 0);
        });

        return response()->json([
            'success' => true,
            'category' => $category,
            'data' => [
                'total_items' => $total,
                'scanned_items' => $scanned,
                'pending_items' => max($total - $scanned, 0),
                'remaining_qty' => (float) $remaining,
            ],
        ]);
    }

    public function list(Request $request)
    {
        $category = $request->string('category', 'sparepart')->toString();
        $search = trim($request->string('search')->toString());
        $query = $this->queryForCategory($category)->orderByDesc('updated_at');

        if ($search !== '') {
            $term = '%' . $search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('kpc', 'like', $term)
                    ->orWhere('barcode', 'like', $term)
                    ->orWhere('namabarang', 'like', $term)
                    ->orWhere('lokasi', 'like', $term)
                    ->orWhere('storagebin_hasil', 'like', $term);
            });
        }

        $rows = $query->limit(200)->get()->map(fn ($row) => $this->formatRow($row));

        return response()->json([
            'success' => true,
            'category' => $category,
            'data' => $rows,
        ]);
    }

    public function lookup(Request $request)
    {
        $category = $request->string('category', 'sparepart')->toString();
        $kpc = trim($request->string('kpc')->toString());

        if ($kpc === '') {
            return response()->json(['success' => false, 'message' => 'Kode/attribute wajib diisi.'], 422);
        }

        $row = $this->queryForCategory($category)->where(function ($q) use ($kpc) {
            $q->where('kpc', $kpc)->orWhere('barcode', $kpc);
        })->first();

        return response()->json([
            'success' => (bool) $row,
            'exists' => (bool) $row,
            'data' => $row ? $this->formatRow($row) : null,
            'message' => $row ? null : 'Kode/attribute tidak ditemukan.',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:sparepart,bahan_baku',
            'kpc' => 'required|string|max:191',
            'qty' => 'required|numeric|min:0.01',
            'lokasi' => 'required|string|max:191',
            'namabarang' => 'required|string|max:191',
            'layout' => 'nullable|string|max:191',
            'keterangan' => 'nullable|string',
            'event_id' => 'nullable|uuid',
            'client_timestamp' => 'nullable|date',
        ]);

        $category = $validated['category'];
        $kpc = trim($validated['kpc']);
        $newQty = (float) $validated['qty'];
        $userName = Auth::user()->name ?? 'Mobile Operator';

        try {
            DB::transaction(function () use ($validated, $category, $kpc, $newQty, $userName) {
                $row = $this->queryForCategory($category)
                    ->where(function ($q) use ($kpc) {
                        $q->where('kpc', $kpc)->orWhere('barcode', $kpc);
                    })->lockForUpdate()->first();

                if ($row) {
                    $existingQty = (float) ($row->qty_scan ?? 0);
                    $initialQty = (float) ($row->berat ?? 0);
                    $remaining = max($initialQty - $existingQty, 0);

                    if ($newQty > $remaining) {
                        throw new \RuntimeException('QTY_EXCEEDS_REMAINING');
                    }

                    $row->qty_scan = $existingQty + $newQty;
                    $row->lokasi_scan = $validated['lokasi'];
                    $row->storagebin_hasil = $validated['layout'] ?: $row->storagebin_hasil;
                    $row->date_scan = now()->toDateString();
                    $row->scanner = $userName;
                    $row->keterangan = $this->appendHistory(
                        $row->keterangan,
                        $userName,
                        $newQty,
                        $validated['layout'] ?: ($row->storagebin_hasil ?: '-'),
                        $validated['keterangan'] ?? null
                    );
                    $row->save();
                } else {
                    SAC::create([
                        'date' => now()->toDateString(),
                        'warehouse' => 'WH',
                        'kpc' => $kpc,
                        'barcode' => $kpc,
                        'namabarang' => $validated['namabarang'],
                        'berat' => $newQty,
                        'lokasi' => $validated['lokasi'],
                        'lokasi_scan' => $validated['lokasi'],
                        'jenis' => self::CATEGORIES[$category],
                        'qty_scan' => $newQty,
                        'keterangan' => $this->appendHistory(
                            null,
                            $userName,
                            $newQty,
                            $validated['layout'] ?: '-',
                            $validated['keterangan'] ?? null
                        ),
                        'storagebin_hasil' => $validated['layout'] ?: null,
                        'date_scan' => now()->toDateString(),
                        'scanner' => $userName,
                    ]);
                }
            });
        } catch (\RuntimeException $e) {
            if ($e->getMessage() !== 'QTY_EXCEEDS_REMAINING') {
                throw $e;
            }
            $row = $this->queryForCategory($category)
                ->where(function ($q) use ($kpc) {
                    $q->where('kpc', $kpc)->orWhere('barcode', $kpc);
                })->first();
            $remaining = $row ? max((float) $row->berat - (float) ($row->qty_scan ?? 0), 0) : null;
            return response()->json([
                'success' => false,
                'message' => 'Qty scan melebihi sisa Qty.',
                'remaining_qty' => $remaining,
            ], 422);
        }

        $row = $this->queryForCategory($category)
            ->where(function ($q) use ($kpc) {
                $q->where('kpc', $kpc)->orWhere('barcode', $kpc);
            })->first();

        return response()->json([
            'success' => true,
            'message' => 'Stock Opname berhasil disimpan.',
            'data' => $row ? $this->formatRow($row) : null,
        ], 201);
    }

    private function queryForCategory(string $category)
    {
        $query = SAC::query();

        if ($category === 'bahan_baku') {
            return $query->where('jenis', self::CATEGORIES['bahan_baku']);
        }

        return $query->where(function ($q) {
            $q->whereNull('jenis')->orWhere('jenis', '!=', self::CATEGORIES['bahan_baku']);
        });
    }

    private function appendHistory(?string $oldText, string $userName, float $qty, string $storagebin, ?string $note): string
    {
        $lines = array_values(array_filter(preg_split("/\r\n|\n|\r/", $oldText ?: '')));
        $scanNumber = count($lines) + 1;
        $line = $scanNumber . '. ' . $userName . ' -> Qty : ' . rtrim(rtrim(number_format($qty, 2, '.', ''), '0'), '.') . ' | SB : ' . $storagebin;
        if ($note && trim($note) !== '') {
            $line .= ' | Catatan : ' . trim($note);
        }
        $lines[] = $line;
        return implode("\n", $lines);
    }

    private function formatRow(SAC $row): array
    {
        $initial = (float) ($row->berat ?? 0);
        $scanned = (float) ($row->qty_scan ?? 0);
        return [
            'id' => $row->id,
            'kpc' => $row->kpc,
            'barcode' => $row->barcode,
            'namabarang' => $row->namabarang,
            'qty' => $initial,
            'qty_scan' => $scanned,
            'remaining_qty' => max($initial - $scanned, 0),
            'lokasi' => $row->lokasi,
            'lokasi_scan' => $row->lokasi_scan,
            'storagebin' => $row->storagebin,
            'storagebin_hasil' => $row->storagebin_hasil,
            'keterangan' => $row->keterangan,
            'scanner' => $row->scanner,
            'date' => $row->date ? (string) $row->date : null,
            'date_scan' => $row->date_scan ? (string) $row->date_scan : null,
        ];
    }
}
