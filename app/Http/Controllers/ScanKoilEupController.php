<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScanKoilEup;
use App\Models\ScanKoilLayout;
use App\Models\ScanKoilPalet;
use Illuminate\Support\Facades\DB;

class ScanKoilEupController extends Controller
{
    public function index()
    {
        // 1. Ambil data scan koil EUP
        $data = ScanKoilEup::with(['layout', 'palet'])->latest()->paginate(10);
        
        // 2. Ambil data Tonase (dikelompokkan berdasarkan layout_id)
        $tonase = ScanKoilLayout::leftJoin('scan_koil_eups', 'scan_koil_layouts.id', '=', 'scan_koil_eups.layout_id')
                    ->select('scan_koil_layouts.nama_layout', DB::raw('COALESCE(SUM(scan_koil_eups.berat), 0) as total_berat'))
                    ->groupBy('scan_koil_layouts.id', 'scan_koil_layouts.nama_layout')
                    ->orderBy('scan_koil_layouts.nama_layout')
                    ->get();
                    
        // 3. Ambil data master untuk Dropdown dan Modal Kelola
        $layouts = ScanKoilLayout::orderBy('nama_layout')->get();
        $palets = ScanKoilPalet::orderBy('nama_palet')->get();

        return view('scan_koil_eup.index', compact('data', 'tonase', 'layouts', 'palets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_coil_eup' => 'required|string|max:255',
            'layout_id' => 'required|exists:scan_koil_layouts,id',
            'berat' => 'required|numeric',
        ]);

        ScanKoilEup::create([
            'no_coil_eup' => $request->no_coil_eup,
            'palet_id' => $request->palet_id ?: null,
            'layout_id' => $request->layout_id,
            'berat' => $request->berat,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        ScanKoilEup::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function storeLayout(Request $request)
    {
        $request->validate([
            'nama_layout' => 'required|string|max:255|unique:scan_koil_layouts,nama_layout'
        ]);

        $layout = ScanKoilLayout::create([
            'nama_layout' => $request->nama_layout
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'data' => $layout, 'message' => 'Layout berhasil ditambahkan']);
        }

        return redirect()->back()->with('success', 'Layout berhasil ditambahkan');
    }

    public function destroyLayout(Request $request, $id)
    {
        ScanKoilLayout::findOrFail($id)->delete();
        
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Layout berhasil dihapus']);
        }
        
        return redirect()->back()->with('success', 'Layout berhasil dihapus');
    }

    public function storePalet(Request $request)
    {
        $request->validate([
            'nama_palet' => 'required|string|max:255|unique:scan_koil_palets,nama_palet'
        ]);

        $palet = ScanKoilPalet::create([
            'nama_palet' => $request->nama_palet
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'data' => $palet, 'message' => 'Palet berhasil ditambahkan']);
        }

        return redirect()->back()->with('success', 'Palet berhasil ditambahkan');
    }

    public function destroyPalet(Request $request, $id)
    {
        ScanKoilPalet::findOrFail($id)->delete();
        
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Palet berhasil dihapus']);
        }
        
        return redirect()->back()->with('success', 'Palet berhasil dihapus');
    }
}
