<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BreakBulk;
use App\Models\BreakBulkScan;
use App\Models\MobileSyncEvent;
use App\Models\PackingList2Item;
use App\Models\PackingReport;
use App\Models\RekapNoSo;
use App\Models\LaporanrepackingM;
use App\Models\SidewallModel;
use App\Models\IDODModel;
use App\Models\CraneM;
use App\Models\ForkliftM;
use App\Models\TraillerM;
use App\Models\EupM;
use App\Models\CrcM;
use App\Models\IngotM;
use App\Models\ResinM;
use App\Models\SAC;
use App\Models\ScanKoilEup;
use App\Models\VerifikasiStiker;
use App\Models\VerifikasiTimbangan;
use App\Services\LogActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MobileSyncEventApiController extends Controller
{
    /**
     * Endpoint universal penerimaan batch event offline dari perangkat mobile.
     * Menerapkan prinsip Event Sourcing dengan idempotensi berbasis event_id (UUID).
     */
    public function syncBatch(Request $request)
    {
        $request->validate([
            'events' => 'required|array|min:1',
            'events.*.event_id' => 'required|string',
            'events.*.module' => 'required|string',
            'events.*.aggregate_id' => 'required',
            'events.*.event_type' => 'required|string',
            'events.*.payload' => 'required|array',
            'events.*.client_timestamp' => 'required|string',
        ]);

        $userId = Auth::id();
        $userName = Auth::user()->name ?? 'Mobile Operator';
        $incomingEvents = $request->input('events');

        $acknowledgedIds = [];
        $failedEvents = [];

        foreach ($incomingEvents as $eventData) {
            $eventId = $eventData['event_id'];

            // 1. Cek idempotensi: bila event_id sudah pernah dicatat, langsung ACK
            $existing = MobileSyncEvent::where('event_id', $eventId)->first();
            if ($existing) {
                $acknowledgedIds[] = $eventId;
                continue;
            }

            DB::beginTransaction();
            try {
                $clientTimestamp = Carbon::parse($eventData['client_timestamp']);

                // 2. Simpan ke Immutable Event Log
                $eventRecord = MobileSyncEvent::create([
                    'event_id' => $eventId,
                    'module' => $eventData['module'],
                    'aggregate_id' => (string) $eventData['aggregate_id'],
                    'event_type' => $eventData['event_type'],
                    'payload' => $eventData['payload'],
                    'device_id' => $eventData['device_id'] ?? null,
                    'user_id' => $userId,
                    'client_timestamp' => $clientTimestamp,
                    'synced_at' => now(),
                    'status' => 'APPLIED',
                ]);

                // 3. Proyeksikan ke model modul bisnis
                $this->projectEventToReadModel($eventRecord, $userName, $userId);

                DB::commit();
                $acknowledgedIds[] = $eventId;
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error("Gagal memproses sync event {$eventId}: " . $e->getMessage());
                $failedEvents[] = [
                    'event_id' => $eventId,
                    'error' => 'Data gagal diproses. Silakan coba sinkronkan kembali.',
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => count($acknowledgedIds) . " event berhasil diproses.",
            'acknowledged_event_ids' => $acknowledgedIds,
            'failed_events' => $failedEvents,
        ]);
    }

    /**
     * Dispatcher proyeksi event ke read model masing-masing modul.
     */
    protected function projectEventToReadModel(MobileSyncEvent $event, string $userName, ?int $userId): void
    {
        $payload = $event->payload;
        $clientTime = $event->client_timestamp;

        switch ($event->module) {
            case 'verifikasi_stiker':
                $this->projectVerifikasiStikerEvent($event, $payload, $userName, $clientTime);
                break;

            case 'packing_list_2':
                $this->projectPackingList2Event($event, $payload, $userId, $clientTime);
                break;

            case 'laporan_packing':
                $this->projectLaporanPackingEvent($event, $payload);
                break;

            case 'break_bulk':
                $this->projectBreakBulkEvent($event, $payload, $userName, $userId, $clientTime);
                break;

            case 'scan_koil_eup':
                $this->projectScanKoilEupEvent($event, $payload, $userName, $userId, $clientTime);
                break;

            case 'verifikasi_timbangan':
                $this->projectVerifikasiTimbanganEvent($event, $payload, $userName, $userId, $clientTime);
                break;

            case 'laporan_repacking':
                $this->projectLaporanRepackingEvent($event, $payload, $userName);
                break;

            case 'laporan_sidewall':
                $this->projectLaporanSidewallEvent($event, $payload);
                break;

            case 'laporan_id_od':
                $this->projectLaporanIdOdEvent($event, $payload);
                break;

            case 'form_check':
                $this->projectFormCheckEvent($event, $payload);
                break;

            case 'stock_opname':
                $this->projectStockOpnameEvent($event, $payload);
                break;

            default:
                Log::warning("Module tidak dikenal untuk event sourcing: {$event->module}");
        }

    }

    protected function projectLaporanRepackingEvent(MobileSyncEvent $event, array $payload, string $userName): void
    {
        if ($event->event_type !== 'REPACKING_REPORT_CREATED') {
            return;
        }

        $record = LaporanrepackingM::where('atributte', $event->aggregate_id)
            ->where('status', 'Pending')
            ->orderBy('id')
            ->first();

        $attributes = [
            'atributte' => $event->aggregate_id,
            'tanggal' => $payload['tanggal'] ?? null,
            'status' => $payload['status'] ?? null,
            'group' => $payload['group'] ?? null,
            'wrapping' => $payload['wrapping'] ?? null,
            'vcipaper' => $payload['vcipaper'] ?? null,
            'keterangan' => $payload['keterangan'] ?? null,
            'created_by' => $userName,
        ];

        if ($record) {
            $record->update($attributes);
        } else {
            LaporanrepackingM::create($attributes);
        }
    }

    protected function projectLaporanSidewallEvent(MobileSyncEvent $event, array $payload): void
    {
        if ($event->event_type !== 'SIDEWALL_REPORT_CREATED') {
            return;
        }

        foreach (($payload['details'] ?? []) as $detail) {
            SidewallModel::create([
                'date' => $payload['date'] ?? null,
                'shift' => $payload['shift'] ?? null,
                'keterangan' => $payload['keterangan'] ?? null,
                'size_sidewall' => $detail['size_sidewall'] ?? null,
                'jumlah' => (int) ($detail['jumlah'] ?? 0),
                'tujuan' => $detail['tujuan'] ?? null,
            ]);
        }
    }

    protected function projectLaporanIdOdEvent(MobileSyncEvent $event, array $payload): void
    {
        if ($event->event_type !== 'ID_OD_REPORT_CREATED') {
            return;
        }

        IDODModel::create([
            'date' => $payload['date'] ?? null,
            'size_id' => $payload['size_id'] ?? null,
            'jumlah_id' => (int) ($payload['jumlah_id'] ?? 0),
            'jumlah_id_ng' => (int) ($payload['jumlah_id_ng'] ?? 0),
            'size_od' => $payload['size_od'] ?? null,
            'jumlah_od' => (int) ($payload['jumlah_od'] ?? 0),
            'jumlah_od_ng' => (int) ($payload['jumlah_od_ng'] ?? 0),
            'tujuan' => $payload['tujuan'] ?? null,
            'shift' => $payload['shift'] ?? null,
            'keterangan' => $payload['keterangan'] ?? null,
        ]);
    }

    protected function projectStockOpnameEvent(MobileSyncEvent $event, array $payload): void
    {
        if ($event->event_type !== 'STOCK_OPNAME_RECORDED') {
            return;
        }

        $category = $payload['category'] ?? 'sparepart';
        $kpc = trim((string) ($payload['kpc'] ?? ''));
        $qty = (float) ($payload['qty'] ?? 0);
        $lokasi = trim((string) ($payload['lokasi'] ?? ''));
        $namabarang = trim((string) ($payload['namabarang'] ?? '-'));
        $layout = trim((string) ($payload['layout'] ?? ''));
        $note = trim((string) ($payload['keterangan'] ?? ''));

        $jenis = $category === 'bahan_baku'
            ? 'BB - BJ - BJS - SP'
            : null;

        $row = SAC::query()->where(function ($q) use ($kpc) {
            $q->where('kpc', $kpc)->orWhere('barcode', $kpc);
        })->lockForUpdate()->first();

        if ($row) {
            $existingQty = (float) ($row->qty_scan ?? 0);
            $initialQty = (float) ($row->berat ?? 0);
            $remaining = max($initialQty - $existingQty, 0);
            if ($qty > $remaining) {
                throw new \RuntimeException('Qty Stock Opname melebihi sisa Qty.');
            }

            $row->qty_scan = $existingQty + $qty;
            $row->lokasi_scan = $lokasi;
            $row->storagebin_hasil = $layout ?: $row->storagebin_hasil;
            $row->date_scan = now()->toDateString();
            $row->scanner = $event->user?->name ?? 'Mobile Operator';

            $lines = array_values(array_filter(preg_split("/\r\n|\n|\r/", $row->keterangan ?: '')));
            $line = (count($lines) + 1) . '. ' . $row->scanner
                . ' -> Qty : ' . rtrim(rtrim(number_format($qty, 2, '.', ''), '0'), '.')
                . ' | SB : ' . ($layout ?: ($row->storagebin_hasil ?: '-'));
            if ($note !== '') {
                $line .= ' | Catatan : ' . $note;
            }
            $lines[] = $line;
            $row->keterangan = implode("\n", $lines);
            $row->save();
            return;
        }

        SAC::create([
            'date' => now()->toDateString(),
            'warehouse' => 'WH',
            'kpc' => $kpc,
            'barcode' => $kpc,
            'namabarang' => $namabarang,
            'berat' => $qty,
            'lokasi' => $lokasi,
            'lokasi_scan' => $lokasi,
            'jenis' => $jenis ?? 'SPAREPART',
            'qty_scan' => $qty,
            'keterangan' => '1. ' . ($event->user?->name ?? 'Mobile Operator')
                . ' -> Qty : ' . rtrim(rtrim(number_format($qty, 2, '.', ''), '0'), '.')
                . ' | SB : ' . ($layout ?: '-')
                . ($note !== '' ? ' | Catatan : ' . $note : ''),
            'storagebin_hasil' => $layout ?: null,
            'date_scan' => now()->toDateString(),
            'scanner' => $event->user?->name ?? 'Mobile Operator',
        ]);
    }

    protected function projectFormCheckEvent(MobileSyncEvent $event, array $payload): void
    {
        if ($event->event_type !== 'FORM_CHECK_SUBMITTED') {
            return;
        }

        $type = $payload['form_type'] ?? null;
        $data = $payload['data'] ?? [];
        $data['user_id'] = $event->user_id;
        $data['date'] ??= now()->toDateString();
        if ($type === 'crane') {
            foreach ([
                'start', 'switch', 'up', 'down', 'ctravel', 'ltravel',
                'emergency', 'speed1', 'speed2', 'block', 'lockert', 'wire',
                'sltravel', 'sirinelt', 'brakeno', 'brakeya', 'bcno',
                'bcya', 'updno', 'updya', 'crcros',
            ] as $field) {
                $data[$field] ??= 'v';
            }
            $data['shift'] ??= '1';
            $data['jenis_crane'] ??= $data['jenis'] ?? 'Crane';
            $data['shift_leader'] ??= '-';
            $data['mtc'] ??= $data['catatan'] ?? '';
        }
        if ($type === 'forklift') {
            foreach ([
                'horn', 'mundur', 'sein', 'rotating', 'stop', 'utama',
                'connector', 'accu', 'parking', 'brake', 'oil', 'raulic',
                'chain', 'allhose', 'steering', 'belts', 'cooland',
                'transmisi', 'ban', 'fork',
            ] as $field) {
                $data[$field] ??= 'v';
            }
            $data['awal'] ??= '-';
            $data['akhir'] ??= '-';
            $data['shift'] ??= '1';
            $data['jenis_forklift'] ??= $data['jenis'] ?? 'Forklift';
            $data['shift_leader'] ??= '-';
            $data['mtc'] ??= $data['catatan'] ?? '';
        }
        if ($type === 'trailler') {
            $requiredTraillerFields = [
                'rantai_pe', 'carrier', 'rantai', 'ban', 'cadangan',
                'sein', 'rotating', 'stop', 'utama', 'kota', 'connector',
                'accu', 'coolant', 'parking', 'brake', 'horn', 'mundur',
                'clamp', 'terpal', 'ganjal', 'pallet', 'apar', 'p3k',
                'fancing', 'triangle', 'tools',
            ];
            foreach ($requiredTraillerFields as $field) {
                $data[$field] ??= 'v';
            }
            $data['jenis_forklift'] ??= $data['jenis'] ?? 'Trailler';
            $data['shift_leader'] ??= '-';
            $data['mtc_name'] ??= $data['mtc'] ?? '';
        }
        if ($type === 'eup') {
            $data['jenis'] ??= 'Penerimaan Pallet';
            $data['sesuai'] ??= 'Ya';
            $data['action'] ??= 'Pallet diterima';
        }
        if ($type === 'crc') {
            $data['shift_leader'] ??= '-';
            $data['jalan'] ??= 'Sesuai';
            $data['radiasi'] ??= '-';
            $data['ket_radiasi'] ??= '-';
        }
        if ($type === 'ingot') {
            $data['shift_leader'] ??= '-';
            $data['jalan'] ??= 'Sesuai';
            $data['time'] ??= '00:00';
        }
        if ($type === 'resin') {
            $data['shift_leader'] ??= '-';
            $data['time'] ??= '00:00';
            $data['radiasi'] ??= '-';
            $data['ket_radiasi'] ??= '-';
        }
        if (isset($data['supplier']) && is_array($data['supplier'])) {
            $data['supplier'] = json_encode(array_values(array_filter($data['supplier'])));
        }
        $model = match ($type) {
            'crane' => CraneM::class,
            'forklift' => ForkliftM::class,
            'trailler' => TraillerM::class,
            'eup' => EupM::class,
            'crc' => CrcM::class,
            'ingot' => IngotM::class,
            'resin' => ResinM::class,
            default => null,
        };

        if ($model === null) {
            throw new \Exception("Jenis Form Check '{$type}' tidak dikenal.");
        }

        $fillable = (new $model())->getFillable();
        $model::create(collect($data)->only($fillable)->toArray());
    }

    /**
     * Proyeksi untuk modul Verifikasi Stiker
     */
    protected function projectVerifikasiStikerEvent(MobileSyncEvent $event, array $payload, string $userName, Carbon $clientTime): void
    {
        $aggregateId = $event->aggregate_id;

        // Cari berdasarkan id atau attribute/barcode
        $stiker = VerifikasiStiker::where('id', $aggregateId)
            ->orWhere('attribute', $aggregateId)
            ->first();

        if (!$stiker) {
            throw new \Exception("Data VerifikasiStiker dengan identifier '{$aggregateId}' tidak ditemukan.");
        }

        if ($event->event_type === 'STIKER_VERIFIED') {
            $checkProduk = (bool) ($payload['check_produk'] ?? false);
            $checkLot = (bool) ($payload['check_lot_no'] ?? false);
            $checkBerat = (bool) ($payload['check_berat'] ?? false);
            $catatan = $payload['catatan'] ?? null;

            $status = ($checkProduk && $checkLot && $checkBerat) ? 'sesuai' : 'tidak_sesuai';

            $stiker->check_produk = $checkProduk;
            $stiker->check_lot_no = $checkLot;
            $stiker->check_berat = $checkBerat;
            $stiker->status_verifikasi = $status;
            $stiker->catatan = $catatan;
            $stiker->verified_by = $userName;
            $stiker->verified_at = $clientTime;
            $stiker->save();

            // Log activity jika ada service LogActivity
            if (class_exists(LogActivity::class)) {
                LogActivity::record(
                    action: 'SYNC_EVENT_STIKER',
                    module: 'Verifikasi Stiker Mobile',
                    description: "Event {$event->event_id}: Stiker {$stiker->attribute} diverifikasi ({$status}) oleh {$userName} via Event Sourcing."
                );
            }
        }
    }

    protected function projectLaporanPackingEvent(MobileSyncEvent $event, array $payload): void
    {
        if ($event->event_type !== 'PACKING_REPORT_CREATED') {
            throw new \Exception("Event type tidak dikenal untuk laporan packing.");
        }

        $attribute = trim($event->aggregate_id);
        if (PackingReport::whereRaw('LOWER(attribute) = ?', [strtolower($attribute)])->exists()) {
            throw new \Exception("Attribute {$attribute} sudah digunakan pada laporan packing.");
        }

        $recordPayload = collect($payload)
            ->except(['event_id', 'aggregate_id', 'event_type', 'client_timestamp'])
            ->toArray();
        $recordPayload['attribute'] = $attribute;
        $recordPayload['no_so'] = filled($recordPayload['no_so'] ?? null)
            ? strtoupper(trim($recordPayload['no_so']))
            : null;

        PackingReport::create($recordPayload);
    }

    /**
     * Proyeksi untuk modul Packing List 2.0
     */
    protected function projectPackingList2Event(MobileSyncEvent $event, array $payload, ?int $userId, Carbon $clientTime): void
    {
        $aggregateId = $event->aggregate_id;
        $item = PackingList2Item::find($aggregateId);

        if (!$item) {
            throw new \Exception("Item PackingList2 #{$aggregateId} tidak ditemukan.");
        }

        if ($event->event_type === 'COIL_VALIDATED') {
            $checkAttr = (bool) ($payload['check_attribute'] ?? false);
            $checkQty = (bool) ($payload['check_quantity'] ?? false);
            $checkLen = (bool) ($payload['check_length'] ?? false);
            $allChecked = $checkAttr && $checkQty && $checkLen;

            $item->status = $allChecked ? 'TERVALIDASI' : 'TIDAK_VALID';
            $item->checklist_result = [
                'attribute' => $checkAttr,
                'quantity' => $checkQty,
                'length' => $checkLen,
            ];
            $item->catatan_verifikasi = $payload['notes'] ?? null;
            $item->validated_by = $userId;
            $item->validated_at = $clientTime;
            $item->save();
        }
    }

    /**
     * Proyeksi untuk modul Setting Break Bulk (Event Sourcing)
     */
    protected function projectBreakBulkEvent(MobileSyncEvent $event, array $payload, string $userName, ?int $userId, Carbon $clientTime): void
    {
        $cleanAttr = trim($payload['atribut'] ?? $event->aggregate_id);

        if ($event->event_type === 'BREAK_BULK_SCANNED') {
            $breakBulkItem = BreakBulk::where('atribut', $cleanAttr)->first();

            $weight = $breakBulkItem && $breakBulkItem->weight > 0
                ? (float) $breakBulkItem->weight
                : (!empty($payload['weight']) ? (float) $payload['weight'] : 0);

            $product = $breakBulkItem && $breakBulkItem->product !== '-'
                ? $breakBulkItem->product
                : (!empty($payload['product']) ? trim($payload['product']) : 'Menunggu Import');

            $noSo = !empty($payload['no_so'])
                ? strtoupper(trim($payload['no_so']))
                : ($breakBulkItem ? $breakBulkItem->no_so : null);

            $trailer = trim($payload['trailer'] ?? 'TR-01');
            $grouping = trim($payload['grouping'] ?? 'CR NON OIL');
            $pod = strtoupper(trim($payload['pod'] ?? 'HOUSTON'));
            $lokasi = strtoupper(trim($payload['lokasi'] ?? 'TB-1'));

            $existingScan = BreakBulkScan::where('atribut', $cleanAttr)->first();

            if ($existingScan) {
                $existingScan->update([
                    'trailer' => $trailer,
                    'weight' => $weight > 0 ? $weight : $existingScan->weight,
                    'product' => ($product && $product !== 'Menunggu Import') ? $product : $existingScan->product,
                    'grouping' => $grouping,
                    'pod' => $pod,
                    'no_so' => $noSo ?: $existingScan->no_so,
                    'lokasi' => $lokasi,
                    'scanned_by' => $userName,
                    'scanned_at' => $clientTime,
                ]);
            } else {
                BreakBulkScan::create([
                    'atribut' => $cleanAttr,
                    'trailer' => $trailer,
                    'weight' => $weight,
                    'product' => $product ?: 'Menunggu Import',
                    'grouping' => $grouping,
                    'pod' => $pod,
                    'no_so' => $noSo,
                    'lokasi' => $lokasi,
                    'scanned_by' => $userName,
                    'scanned_at' => $clientTime,
                ]);
            }

            if ($breakBulkItem) {
                $updateData = [
                    'status' => 'scanned',
                    'scanned_at' => $clientTime,
                    'scanned_by' => $userId,
                ];
                if (empty($breakBulkItem->no_so) && !empty($noSo)) {
                    $updateData['no_so'] = $noSo;
                }
                $breakBulkItem->update($updateData);
            }
        } elseif ($event->event_type === 'BREAK_BULK_DELETED') {
            BreakBulkScan::where('atribut', $cleanAttr)->delete();
            BreakBulk::where('atribut', $cleanAttr)->update([
                'status' => 'pending',
                'scanned_at' => null,
                'scanned_by' => null,
            ]);
        }
    }

    /**
     * Proyeksi untuk modul Scan Koil EUP (Event Sourcing)
     */
    protected function projectScanKoilEupEvent(MobileSyncEvent $event, array $payload, string $userName, ?int $userId, Carbon $clientTime): void
    {
        $noCoil = trim($payload['no_coil_eup'] ?? (string) $event->aggregate_id);

        if ($event->event_type === 'EUP_SCANNED') {
            $layoutId = (int) ($payload['layout_id'] ?? 0);
            $paletId = !empty($payload['palet_id']) ? (int) $payload['palet_id'] : null;
            $berat = (float) ($payload['berat'] ?? 0);
            $catatan = $payload['keterangan'] ?? null;

            // Idempotent: Update jika sudah ada untuk no_coil_eup & layout_id, atau buat baru
            ScanKoilEup::updateOrCreate(
                [
                    'no_coil_eup' => $noCoil,
                    'layout_id' => $layoutId,
                ],
                [
                    'palet_id' => $paletId,
                    'berat' => $berat,
                    'keterangan' => $catatan,
                    'created_at' => $clientTime,
                    'updated_at' => $clientTime,
                ]
            );

            if (class_exists(LogActivity::class)) {
                LogActivity::record(
                    action: 'SYNC_EVENT_EUP',
                    module: 'Scan Koil EUP Mobile',
                    description: "Event {$event->event_id}: Koil EUP {$noCoil} ({$berat} kg) disinkronkan oleh {$userName}."
                );
            }
        } elseif ($event->event_type === 'EUP_DELETED') {
            ScanKoilEup::where('id', $event->aggregate_id)
                ->orWhere('no_coil_eup', $noCoil)
                ->delete();
        }
    }

    /**
     * Proyeksi untuk modul Verifikasi Timbangan (Event Sourcing)
     */
    protected function projectVerifikasiTimbanganEvent(MobileSyncEvent $event, array $payload, string $userName, ?int $userId, Carbon $clientTime): void
    {
        $label = 9340;

        if ($event->event_type === 'TIMBANGAN_VERIFIED') {
            $actual = (float) ($payload['actual'] ?? 0);
            $selisih = $actual - $label;
            $status = ($selisih < -10 || $selisih > 10) ? 'NOT OK' : 'OK';
            $tanggal = $payload['tanggal'] ?? $clientTime->toDateTimeString();

            VerifikasiTimbangan::create([
                'tanggal' => $tanggal,
                'label' => $label,
                'actual' => $actual,
                'selisih' => $selisih,
                'status' => $status,
                'operator_name' => $payload['operator_name'] ?? $userName,
                'created_at' => $clientTime,
                'updated_at' => $clientTime,
            ]);

            if (class_exists(LogActivity::class)) {
                LogActivity::record(
                    action: 'SYNC_EVENT_TIMBANGAN',
                    module: 'Verifikasi Timbangan Mobile',
                    description: "Event {$event->event_id}: Timbangan diverifikasi ({$status}, actual: {$actual} kg) oleh {$userName}."
                );
            }
        } elseif ($event->event_type === 'TIMBANGAN_TINDAK_LANJUT') {
            $timbanganId = $event->aggregate_id;
            $timbangan = VerifikasiTimbangan::find($timbanganId);
            if ($timbangan) {
                $actualSetelah = (float) ($payload['actual_setelah'] ?? 0);
                $selisihSetelah = $actualSetelah - $label;

                $timbangan->update([
                    'tindak_lanjut' => $payload['tindak_lanjut'] ?? 'Kalibrasi via Mobile',
                    'actual_setelah' => $actualSetelah,
                    'selisih_setelah' => $selisihSetelah,
                    'status' => 'OK',
                    'updated_at' => $clientTime,
                ]);
            }
        } elseif ($event->event_type === 'TIMBANGAN_DELETED') {
            VerifikasiTimbangan::where('id', $event->aggregate_id)->delete();
        }
    }
}
