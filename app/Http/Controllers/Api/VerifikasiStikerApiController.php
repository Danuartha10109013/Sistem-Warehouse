<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VerifikasiStiker;
use App\Services\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiStikerApiController extends Controller
{
    /**
     * Ringkasan KPI verifikasi stiker untuk dashboard mobile.
     */
    public function getSummary()
    {
        $total = VerifikasiStiker::count();
        $totalBelum = VerifikasiStiker::where('status_verifikasi', 'belum')->count();
        $totalSesuai = VerifikasiStiker::where('status_verifikasi', 'sesuai')->count();
        $totalTidakSesuai = VerifikasiStiker::where('status_verifikasi', 'tidak_sesuai')->count();
        $totalHariIni = VerifikasiStiker::whereIn('status_verifikasi', ['sesuai', 'tidak_sesuai'])
            ->whereDate('verified_at', today())
            ->count();

        return response()->json([
            'success' => true,
            'data'    => [
                'total_stiker'         => $total,
                'total_belum'          => $totalBelum,
                'total_sesuai'         => $totalSesuai,
                'total_tidak_sesuai'   => $totalTidakSesuai,
                'diverifikasi_hari_ini'=> $totalHariIni,
            ],
        ]);
    }

    /**
     * Daftar item stiker dengan filter status & pencarian.
     */
    public function getStikers(Request $request)
    {
        $query = VerifikasiStiker::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status_verifikasi', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('attribute', 'like', "%{$search}%")
                  ->orWhere('supplier_lot_no', 'like', "%{$search}%")
                  ->orWhere('produk', 'like', "%{$search}%");
            });
        }

        if ($request->boolean('all')) {
            $allItems = $query->orderByRaw("FIELD(status_verifikasi, 'belum', 'tidak_sesuai', 'sesuai')")
                ->orderBy('id', 'desc')
                ->limit(500)
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $allItems,
                'meta'    => [
                    'current_page' => 1,
                    'last_page'    => 1,
                    'per_page'     => $allItems->count(),
                    'total'        => $allItems->count(),
                ],
            ]);
        }

        $perPage = (int) $request->get('per_page', 50);
        $stikers = $query->orderByRaw("FIELD(status_verifikasi, 'belum', 'tidak_sesuai', 'sesuai')")
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => $stikers->items(),
            'meta'    => [
                'current_page' => $stikers->currentPage(),
                'last_page'    => $stikers->lastPage(),
                'per_page'     => $stikers->perPage(),
                'total'        => $stikers->total(),
            ],
        ]);
    }

    /**
     * Cari stiker berdasarkan pemindaian barcode / nomor seri / lot.
     */
    public function scan(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = trim($request->code);

        $stiker = VerifikasiStiker::where('attribute', $code)
            ->orWhere('supplier_lot_no', $code)
            ->first();

        if (!$stiker) {
            return response()->json([
                'success' => false,
                'message' => "Stiker / Barcode '{$code}' tidak ditemukan di database.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Stiker berhasil ditemukan.',
            'data'    => $stiker,
        ]);
    }

    /**
     * Verifikasi langsung (Online fallback).
     */
    public function validateDirect(Request $request, $id)
    {
        $stiker = VerifikasiStiker::findOrFail($id);

        $request->validate([
            'check_produk' => 'required|boolean',
            'check_lot_no' => 'required|boolean',
            'check_berat'  => 'required|boolean',
            'catatan'      => 'nullable|string',
        ]);

        $checkProduk = (bool) $request->check_produk;
        $checkLot    = (bool) $request->check_lot_no;
        $checkBerat  = (bool) $request->check_berat;
        $status      = ($checkProduk && $checkLot && $checkBerat) ? 'sesuai' : 'tidak_sesuai';
        $userName    = Auth::user()->name ?? 'Mobile Operator';

        $stiker->update([
            'check_produk'      => $checkProduk,
            'check_lot_no'      => $checkLot,
            'check_berat'       => $checkBerat,
            'status_verifikasi' => $status,
            'catatan'           => $request->catatan,
            'verified_by'       => $userName,
            'verified_at'       => now(),
        ]);

        if (class_exists(LogActivity::class)) {
            LogActivity::record(
                action: 'VERIFIKASI_STIKER_MOBILE',
                module: 'Verifikasi Stiker Mobile',
                description: "Stiker {$stiker->attribute} diverifikasi langsung ({$status}) oleh {$userName}."
            );
        }

        return response()->json([
            'success' => true,
            'message' => "Stiker berhasil diverifikasi dengan status: {$status}.",
            'data'    => $stiker,
        ]);
    }
}
