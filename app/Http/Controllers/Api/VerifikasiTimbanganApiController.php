<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VerifikasiTimbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifikasiTimbanganApiController extends Controller
{
    const LABEL_STANDAR = 9340;
    const TOLERANSI = 10;

    /**
     * Ringkasan KPI Verifikasi Timbangan untuk Dashboard Mobile
     */
    public function summary()
    {
        $totalPemeriksaan = VerifikasiTimbangan::count();
        $totalOk = VerifikasiTimbangan::where('status', 'OK')->count();
        $totalNotOk = VerifikasiTimbangan::where('status', 'NOT OK')->count();
        $perluTindakLanjut = VerifikasiTimbangan::where('status', 'NOT OK')
            ->where(function ($q) {
                $q->whereNull('tindak_lanjut')->orWhere('tindak_lanjut', '');
            })
            ->count();

        $latest = VerifikasiTimbangan::orderBy('tanggal', 'desc')->first();

        return response()->json([
            'success' => true,
            'data' => [
                'total_pemeriksaan' => $totalPemeriksaan,
                'total_ok' => $totalOk,
                'total_not_ok' => $totalNotOk,
                'perlu_tindak_lanjut' => $perluTindakLanjut,
                'label_standar' => self::LABEL_STANDAR,
                'toleransi' => self::TOLERANSI,
                'latest_status' => $latest ? $latest->status : 'OK',
                'latest_tanggal' => $latest ? $latest->tanggal : null,
            ],
        ]);
    }

    /**
     * Daftar Riwayat Verifikasi Timbangan
     */
    public function index(Request $request)
    {
        $query = VerifikasiTimbangan::orderBy('tanggal', 'desc');

        if ($request->filled('status')) {
            $status = strtoupper(trim($request->status));
            if ($status === 'OK' || $status === 'NOT OK') {
                $query->where('status', $status);
            } elseif ($status === 'PERLU_TINDAK_LANJUT') {
                $query->where('status', 'NOT OK')
                    ->where(function ($q) {
                        $q->whereNull('tindak_lanjut')->orWhere('tindak_lanjut', '');
                    });
            }
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('operator_name', 'like', "%{$search}%")
                    ->orWhere('tindak_lanjut', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        if ($request->boolean('all', false)) {
            $data = $query->get();
            return response()->json([
                'success' => true,
                'data' => $data,
                'total' => $data->count(),
            ]);
        }

        $perPage = (int) $request->get('per_page', 20);
        $paginated = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $paginated->items(),
            'total' => $paginated->total(),
            'has_more' => $paginated->hasMorePages(),
            'page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
        ]);
    }

    /**
     * Input Hasil Pemeriksaan Timbangan Baru (Online Direct)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'actual' => 'required|numeric|min:1',
        ]);

        $label = self::LABEL_STANDAR;
        $actual = (float) $validated['actual'];
        $selisih = $actual - $label;

        // Toleransi selisih -10 sampai +10 kg
        $status = ($selisih < -self::TOLERANSI || $selisih > self::TOLERANSI) ? 'NOT OK' : 'OK';

        $userName = Auth::check() ? Auth::user()->name : ($request->input('operator_name') ?? 'Operator Mobile');

        $timbangan = VerifikasiTimbangan::create([
            'tanggal' => $validated['tanggal'],
            'label' => $label,
            'actual' => $actual,
            'selisih' => $selisih,
            'status' => $status,
            'operator_name' => $userName,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Verifikasi timbangan tercatat ({$status}, selisih {$selisih} kg).",
            'data' => $timbangan,
        ]);
    }

    /**
     * Tindak Lanjut Kalibrasi untuk Item yang NOT OK
     */
    public function tindakLanjut(Request $request, $id)
    {
        $validated = $request->validate([
            'tindak_lanjut' => 'required|string',
            'actual_setelah' => 'required|numeric|min:1',
        ]);

        $timbangan = VerifikasiTimbangan::find($id);
        if (!$timbangan) {
            return response()->json([
                'success' => false,
                'message' => 'Data verifikasi timbangan tidak ditemukan.',
            ], 404);
        }

        $label = $timbangan->label ?: self::LABEL_STANDAR;
        $actualSetelah = (float) $validated['actual_setelah'];
        $selisihSetelah = $actualSetelah - $label;

        $timbangan->update([
            'tindak_lanjut' => $validated['tindak_lanjut'],
            'actual_setelah' => $actualSetelah,
            'selisih_setelah' => $selisihSetelah,
            'status' => 'OK',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tindak lanjut kalibrasi berhasil disimpan.',
            'data' => $timbangan,
        ]);
    }

    /**
     * Hapus Data Pemeriksaan Timbangan
     */
    public function destroy($id)
    {
        $timbangan = VerifikasiTimbangan::find($id);
        if (!$timbangan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
            ], 404);
        }

        $timbangan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data verifikasi timbangan berhasil dihapus.',
        ]);
    }
}

