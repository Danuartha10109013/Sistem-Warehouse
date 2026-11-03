<?php

namespace App\Http\Controllers;

use App\Exports\VerifikasiStikerHasilScanExport;
use App\Imports\VerifikasiStikerImport;
use App\Models\VerifikasiStiker;
use App\Models\VerifikasiStikerNotifContact;
use App\Services\WhatsAppNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VerifikasiStikerController extends Controller
{
    // [TAG: HALAMAN UTAMA] Dashboard Verifikasi Stiker dengan Filter Tanggal Input
    public function index(Request $request)
    {
        $availableDates = VerifikasiStiker::select('tanggal_input')
            ->whereNotNull('tanggal_input')
            ->distinct()
            ->orderBy('tanggal_input', 'desc')
            ->pluck('tanggal_input');

        $selectedDate = $request->get('tanggal_input', $availableDates->first() ? $availableDates->first()->format('Y-m-d') : now()->toDateString());

        $query = VerifikasiStiker::query();
        if ($selectedDate !== 'all') {
            $query->whereDate('tanggal_input', $selectedDate);
        }

        $totalData = (clone $query)->count();
        $totalSesuai = (clone $query)->where('status_verifikasi', 'sesuai')->count();
        $totalBelum = (clone $query)->where('status_verifikasi', 'belum')->count();
        $totalTidakSesuai = (clone $query)->where('status_verifikasi', 'tidak_sesuai')->count();

        $recentVerifikasi = (clone $query)->whereNotNull('verified_at')
            ->orderBy('verified_at', 'desc')
            ->limit(10)
            ->get();

        return view('verifikasi_stiker.dashboard.index', compact(
            'availableDates',
            'selectedDate',
            'totalData',
            'totalSesuai',
            'totalBelum',
            'totalTidakSesuai',
            'recentVerifikasi'
        ));
    }

    // [TAG: HALAMAN SCAN] Form Scan & 3 Ceklis Verifikasi
    public function scan(Request $request)
    {
        $availableDates = VerifikasiStiker::select('tanggal_input')
            ->whereNotNull('tanggal_input')
            ->distinct()
            ->orderBy('tanggal_input', 'desc')
            ->pluck('tanggal_input');

        $selectedDate = $request->get('tanggal_input', $availableDates->first() ? $availableDates->first()->format('Y-m-d') : now()->toDateString());

        $verifiedQuery = VerifikasiStiker::whereIn('status_verifikasi', ['sesuai', 'tidak_sesuai'])
            ->orderBy('verified_at', 'desc')
            ->orderBy('updated_at', 'desc');

        if ($selectedDate !== 'all') {
            $verifiedQuery->whereDate('tanggal_input', $selectedDate);
        }

        $riwayatVerifikasi = $verifiedQuery->get();

        return view('verifikasi_stiker.scan.index', compact('availableDates', 'selectedDate', 'riwayatVerifikasi'));
    }

    // [TAG: AJAX CHECK ATTRIBUTE] Pencarian data berdasarkan Attribute & Tanggal Input
    public function checkAttribute(Request $request)
    {
        $request->validate([
            'attribute'     => 'required|string',
            'tanggal_input' => 'nullable|string',
        ]);

        $search = trim($request->attribute);
        $tglInput = $request->tanggal_input;

        $query = VerifikasiStiker::where('attribute', $search);

        if ($tglInput && $tglInput !== 'all') {
            $query->whereDate('tanggal_input', $tglInput);
        }

        // 1. Cari record yang belum diverifikasi terlebih dahulu pada tanggal yang dipilih
        $item = (clone $query)
            ->orderByRaw("CASE WHEN status_verifikasi = 'belum' THEN 0 ELSE 1 END")
            ->orderBy('id', 'desc')
            ->first();

        // 2. Jika tidak ditemukan di tanggal terpilih (misal diinput kemarin/beda tanggal),
        // otomatis fallback cari di semua tanggal input agar operator tetap bisa scan tanpa perlu ubah filter
        if (!$item) {
            $item = VerifikasiStiker::where('attribute', $search)
                ->orderByRaw("CASE WHEN status_verifikasi = 'belum' THEN 0 ELSE 1 END")
                ->orderBy('tanggal_input', 'desc')
                ->orderBy('id', 'desc')
                ->first();
        }

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Attribute "' . $search . '" tidak ditemukan dalam data master.',
            ], 404);
        }

        $remainingCount = VerifikasiStiker::where('attribute', $search)
            ->where('status_verifikasi', 'belum')
            ->count();

        $isDiffDate = ($tglInput && $tglInput !== 'all' && $item->tanggal_input && $item->tanggal_input->format('Y-m-d') !== $tglInput);

        return response()->json([
            'success' => true,
            'data' => [
                'id'                  => $item->id,
                'tanggal_input'       => $item->tanggal_input ? $item->tanggal_input->format('d/m/Y') : null,
                'is_different_date'   => $isDiffDate,
                'different_date_note' => $isDiffDate ? 'Input Tanggal ' . $item->tanggal_input->format('d/m/Y') : null,
                'attribute'           => $item->attribute,
                'produk'              => $item->produk,
                'supplier_lot_no'     => $item->supplier_lot_no,
                'tgl_dn'              => $item->tgl_dn,
                'berat'               => number_format($item->berat, 2, '.', ','),
                'berat_raw'           => $item->berat,
                'status_verifikasi'   => $item->status_verifikasi,
                'check_produk'        => (bool) $item->check_produk,
                'check_lot_no'        => (bool) $item->check_lot_no,
                'check_berat'         => (bool) $item->check_berat,
                'verified_at'         => $item->verified_at ? $item->verified_at->format('d-m-Y H:i:s') : null,
                'verified_by'         => $item->verified_by,
                'remaining_belum'     => $remainingCount,
            ],
        ]);
    }

    // [TAG: SIMPAN VERIFIKASI] Verifikasi dengan 3 Checklist (Produk, Lot No, Berat)
    public function verify(Request $request)
    {
        $request->validate([
            'id'           => 'required|exists:verifikasi_stikers,id',
            'check_produk' => 'required|boolean',
            'check_lot_no' => 'required|boolean',
            'check_berat'  => 'required|boolean',
            'catatan'      => 'nullable|string',
        ]);

        $item = VerifikasiStiker::findOrFail($request->id);

        $checkProduk = filter_var($request->check_produk, FILTER_VALIDATE_BOOLEAN);
        $checkLotNo  = filter_var($request->check_lot_no, FILTER_VALIDATE_BOOLEAN);
        $checkBerat  = filter_var($request->check_berat, FILTER_VALIDATE_BOOLEAN);

        $item->check_produk = $checkProduk;
        $item->check_lot_no = $checkLotNo;
        $item->check_berat  = $checkBerat;

        // Ketiganya wajib dicentang agar status menjadi "sesuai"
        if ($checkProduk && $checkLotNo && $checkBerat) {
            $item->status_verifikasi = 'sesuai';
        } else {
            $item->status_verifikasi = 'tidak_sesuai';
        }

        $item->verified_at = now();
        $item->verified_by = Auth::check() ? Auth::user()->name : 'Operator';
        $item->catatan = $request->catatan;
        $item->save();

        // [TAG: NOTIFIKASI WA] Kirim notifikasi jika hasil verifikasi tidak sesuai
        $waStatus = null;
        if ($item->status_verifikasi === 'tidak_sesuai') {
            $waStatus = WhatsAppNotificationService::sendMismatchAlert($item);
        }

        if ($request->ajax()) {
            $msg = $item->status_verifikasi === 'sesuai' 
                ? 'Semua 3 atribut stiker valid (Sesuai OK)!' 
                : 'Verifikasi disimpan sebagai TIDAK SESUAI (atribut belum lengkap).';

            if ($waStatus) {
                if ($waStatus['success']) {
                    $msg .= ' 📲 Notifikasi WhatsApp berhasil dikirim ke nomor pengawas.';
                } else {
                    $msg .= ' ⚠️ Info WA: ' . $waStatus['message'];
                }
            }

            return response()->json([
                'success'   => true,
                'status'    => $item->status_verifikasi,
                'message'   => $msg,
                'wa_status' => $waStatus,
                'data'      => $item,
            ]);
        }

        return redirect()->back()->with('success', 'Status verifikasi berhasil disimpan!');
    }

    // [TAG: HALAMAN DATA] Daftar data tabel dan filter per tanggal input
    public function data(Request $request)
    {
        $availableDates = VerifikasiStiker::select('tanggal_input')
            ->whereNotNull('tanggal_input')
            ->distinct()
            ->orderBy('tanggal_input', 'desc')
            ->pluck('tanggal_input');

        $query = VerifikasiStiker::query();

        if ($request->filled('tanggal_input') && $request->tanggal_input !== 'all') {
            $query->whereDate('tanggal_input', $request->tanggal_input);
        }

        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('attribute', 'like', "%{$s}%")
                  ->orWhere('produk', 'like', "%{$s}%")
                  ->orWhere('supplier_lot_no', 'like', "%{$s}%");
            });
        }

        $data = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        return view('verifikasi_stiker.data.index', compact('data', 'availableDates'));
    }

    // [TAG: IMPORT EXCEL] Proses import file Excel dengan Tanggal Input Admin
    public function import(Request $request)
    {
        $request->validate([
            'file_excel'    => 'required|mimes:xlsx,xls,csv|max:10240',
            'tanggal_input' => 'nullable|date',
        ]);

        try {
            $tglInput = $request->tanggal_input ?: now()->toDateString();
            $import = new VerifikasiStikerImport($tglInput);
            Excel::import($import, $request->file('file_excel'));

            $msg = "Berhasil mengimport {$import->importedCount} data bahan baku berawalan CR_ untuk tanggal {$tglInput}!";
            $details = [];
            if ($import->skippedNonCrCount > 0) {
                $details[] = "{$import->skippedNonCrCount} data dilewati karena tidak berawalan 'CR_'";
            }
            if ($import->skippedDuplicateCount > 0) {
                $details[] = "{$import->skippedDuplicateCount} data dilewati karena kode atribut CR_ sudah terdaftar sebelumnya";
            }
            if (!empty($details)) {
                $msg .= " (" . implode(', ', $details) . ").";
            }

            return redirect()->route('verifikasi-stiker.data', ['tanggal_input' => $tglInput])
                ->with('success', $msg);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengimport Excel: ' . $e->getMessage());
        }
    }

    // [TAG: EXPORT EXCEL] Export hasil verifikasi stiker per hari
    public function exportExcel(Request $request)
    {
        $tgl = $request->get('tanggal_input', now()->toDateString());
        $query = VerifikasiStiker::whereIn('status_verifikasi', ['sesuai', 'tidak_sesuai'])
            ->orderBy('verified_at', 'desc')
            ->orderBy('updated_at', 'desc');

        if ($tgl && $tgl !== 'all') {
            $query->whereDate('tanggal_input', $tgl);
            $filename = 'Hasil_Verifikasi_Stiker_' . $tgl . '.xlsx';
            $titleDate = \Carbon\Carbon::parse($tgl)->format('d/m/Y');
        } else {
            $filename = 'Hasil_Verifikasi_Stiker_Semua_Tanggal.xlsx';
            $titleDate = 'Semua Tanggal';
        }

        $items = $query->get();
        $summary = [
            'total'        => $items->count(),
            'sesuai'       => $items->where('status_verifikasi', 'sesuai')->count(),
            'tidak_sesuai' => $items->where('status_verifikasi', 'tidak_sesuai')->count(),
        ];

        return Excel::download(new VerifikasiStikerHasilScanExport($titleDate, $items, $summary), $filename);
    }

    // [TAG: HAPUS DATA] Hapus satu item
    public function destroy($id)
    {
        $item = VerifikasiStiker::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // [TAG: RESET SEMUA] Reset seluruh data verifikasi stiker
    public function truncate()
    {
        VerifikasiStiker::truncate();
        return redirect()->back()->with('success', 'Seluruh data berhasil di-reset!');
    }

    /**
     * Cek apakah user saat ini memiliki hak akses untuk mengelola kontak notifikasi WhatsApp
     */
    private function checkWaNotifAccess(): void
    {
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }
        $types = json_decode($user->type ?? '[]', true) ?? [];
        if ($user->role != 0 && !in_array('all', $types) && !in_array('VS_WA', $types)) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk mengelola Kontak Notifikasi WhatsApp.');
        }
    }

    // [TAG: NOTIF WA - DAFTAR KONTAK] Menampilkan daftar nomor penerima WhatsApp & status Fonnte
    public function notifWaIndex()
    {
        $this->checkWaNotifAccess();

        $contacts = VerifikasiStikerNotifContact::orderBy('is_active', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        $tokenConfigured = !empty(config('services.fonnte.token') ?: env('FONNTE_TOKEN'));
        $fonnteDevice = WhatsAppNotificationService::getDeviceStatus();

        return view('verifikasi_stiker.notif_wa.index', compact('contacts', 'tokenConfigured', 'fonnteDevice'));
    }

    // [TAG: NOTIF WA - SIMPAN KONTAK] Menambah nomor penerima WhatsApp baru
    public function notifWaStore(Request $request)
    {
        $this->checkWaNotifAccess();

        $request->validate([
            'nama'     => 'required|string|max:100',
            'nomor_wa' => 'required|string|max:30',
            'jabatan'  => 'nullable|string|max:100',
        ]);

        $cleanNomor = preg_replace('/[^0-9]/', '', $request->nomor_wa);

        VerifikasiStikerNotifContact::create([
            'nama'      => $request->nama,
            'nomor_wa'  => $cleanNomor,
            'jabatan'   => $request->jabatan,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Nomor kontak WhatsApp berhasil ditambahkan!');
    }

    // [TAG: NOTIF WA - UPDATE KONTAK] Edit nomor penerima WhatsApp
    public function notifWaUpdate(Request $request, $id)
    {
        $this->checkWaNotifAccess();

        $request->validate([
            'nama'     => 'required|string|max:100',
            'nomor_wa' => 'required|string|max:30',
            'jabatan'  => 'nullable|string|max:100',
        ]);

        $contact = VerifikasiStikerNotifContact::findOrFail($id);
        $cleanNomor = preg_replace('/[^0-9]/', '', $request->nomor_wa);

        $contact->update([
            'nama'     => $request->nama,
            'nomor_wa' => $cleanNomor,
            'jabatan'  => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Kontak WhatsApp berhasil diperbarui!');
    }

    // [TAG: NOTIF WA - TOGGLE STATUS] Aktifkan / Nonaktifkan kontak
    public function notifWaToggle($id)
    {
        $this->checkWaNotifAccess();

        $contact = VerifikasiStikerNotifContact::findOrFail($id);
        $contact->is_active = !$contact->is_active;
        $contact->save();

        $statusText = $contact->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Kontak {$contact->nama} berhasil {$statusText}!");
    }

    // [TAG: NOTIF WA - HAPUS KONTAK] Hapus nomor penerima WhatsApp
    public function notifWaDestroy($id)
    {
        $this->checkWaNotifAccess();

        $contact = VerifikasiStikerNotifContact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Kontak WhatsApp berhasil dihapus!');
    }

    // [TAG: NOTIF WA - TEST KIRIM] Uji coba pengiriman pesan ke satu atau seluruh nomor aktif
    public function notifWaTest(Request $request)
    {
        $this->checkWaNotifAccess();
        $request->validate([
            'target' => 'nullable|string',
        ]);

        if ($request->filled('target')) {
            $targets = preg_replace('/[^0-9]/', '', $request->target);
        } else {
            $contacts = VerifikasiStikerNotifContact::active()->get();
            if ($contacts->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada kontak aktif untuk dikirimi tes.');
            }
            $targets = $contacts->pluck('nomor_wa')->map(function ($no) {
                return preg_replace('/[^0-9]/', '', $no);
            })->filter()->implode(',');
        }

        $result = WhatsAppNotificationService::sendTestMessage($targets);

        if ($result['success']) {
            return redirect()->back()->with('success', 'Pesan uji coba berhasil dikirim via Fonnte!');
        }

        return redirect()->back()->with('error', 'Gagal mengirim pesan uji coba: ' . $result['message']);
    }
}
