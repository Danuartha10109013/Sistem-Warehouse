<?php

namespace App\Http\Controllers;
use App\Exports\SIKExport;
use App\Models\SuratM;
use Carbon\Carbon;
use App\Models\PackingReport;
use App\Models\RekapNoSo;
use App\Imports\RekapNoSoImport;
use App\Exports\TemplateRekapNoSoExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PackingController extends Controller
{
    public function index(Request $request)
    {
        $query = PackingReport::query();

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $data = $query->orderBy('date', 'desc')->get();

        return view('packing.pages.index', compact('data'));
    }

    public function add (){
        $attributes = PackingReport::pluck('attribute')->filter()->values()->toArray();
        return view ('packing.pages.add', compact('attributes'));
    }

    public function checkAttribute(Request $request)
    {
        $attribute = $request->input('attribute');
        if (!$attribute) {
            return response()->json(['exists' => false]);
        }

        $exists = PackingReport::where('attribute', $attribute)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // --- VALIDATION ---
        $validated = $request->validate([
            'date'        => 'required|date',
            'attribute'   => 'required|string|max:255',
            'group'       => 'required|string|max:50',
            'layout'      => 'required|string|max:255',
            'no_so'       => 'nullable|string|max:255',
            'kondisi'     => 'required|string|max:255',
            'plastik'     => 'required|string|max:255',
            'wrapping'    => 'required|string|max:255',
            'impraboard'  => 'required|string|max:255',
            'idod'        => 'required|string|max:255',
            'pallet'      => 'required|string|max:255',
            'bandazer'    => 'required|string|max:255',
            'label'    => 'required|string|max:255',
            'inner'    => 'required|string|max:255',
            'outer'    => 'required|string|max:255',
            'inerprotector'    => 'required|string|max:255',
            'lainnya'    => 'nullable',
        ]);

        // --- SAVE DATA ---

        $validated['no_so'] = isset($validated['no_so'])
            ? strtoupper($validated['no_so'])
            : null;

        PackingReport::create($validated);

        // --- SWEET ALERT SUCCESS ---
        // Flash session untuk SweetAlert di blade
        return redirect()->route('pac')
            ->with('success', 'Data berhasil disimpan!');
    }

//     public function update(Request $request, $id)
// {
//     // Validasi sesuai field
//     $validated = $request->validate([
//         'date'       => 'required',
//         'attribute'  => 'required|string|max:255',
//         'group'      => 'required|string',
//         'layout'     => 'required|string',
//         'no_so'      => 'required|string',
//         'kondisi'    => 'required|string',
//         'plastik'    => 'required|string',
//         'wrapping'   => 'required|string',
//         'impraboard' => 'required|string',
//         'idod'       => 'required|string',
//         'pallet'     => 'required|string',
//         'bandazer'   => 'required|string',
//         'label'   => 'required|string',
//         'inner'   => 'required|string',
//         'outer'   => 'required|string',
//         'lainnya'   => 'nullable|string',
//     ]);


//     // Ambil data berdasarkan ID
//     $data = PackingReport::findOrFail($id);
//     $validated['no_so'] = strtoupper($validated['no_so']);

//     // Update data
//     $data->update([
//         'date'       => $request->date,
//         'attribute'  => $request->attribute,
//         'group'      => $request->group,
//         'layout'     => $request->layout,
//         'no_so'      => $request->no_so,
//         'kondisi'    => $request->kondisi,
//         'plastik'    => $request->plastik,
//         'wrapping'   => $request->wrapping,
//         'impraboard' => $request->impraboard,
//         'idod'       => $request->idod,
//         'pallet'     => $request->pallet,
//         'bandazer'   => $request->bandazer,
//         'label'   => $request->label,
//         'inner'   => $request->inner,
//         'outer'   => $request->outer,
//         'lainnya'   => $request->lainnya,
//     ]);

//     return redirect()->back()->with('success', 'Data berhasil diperbarui!');
// }

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'date'       => 'required',
        'attribute'  => 'required|string|max:255',
        'group'      => 'required|string',
        'layout'     => 'required|string',
        'no_so'      => 'required|string',
        'kondisi'    => 'required|string',
        'plastik'    => 'required|string',
        'wrapping'   => 'required|string',
        'impraboard' => 'required|string',
        'idod'       => 'required|string',
        'pallet'     => 'required|string',
        'bandazer'   => 'required|string',
        'label'      => 'required|string',
        'inner'      => 'required|string',
        'outer'      => 'required|string',
        'inerprotector'      => 'required|string',
        'lainnya'    => 'nullable|string',
    ]);

    // AUTO UPPERCASE
    $validated['no_so'] = strtoupper($validated['no_so']);

    $data = PackingReport::findOrFail($id);

    $data->update($validated);

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');
}

public function destroy($id)
{
    // Cari data berdasarkan ID
    $data = PackingReport::findOrFail($id);

    // Hapus data
    $data->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus!');
}

    // [TAG: HALAMAN REKAP SO] Tampilan form input & import rekap nomor SO
    public function rekapSo(Request $request)
    {
        $search = $request->input('search');
        $query = RekapNoSo::query();

        if ($search) {
            $query->where('attribute', 'like', "%{$search}%")
                  ->orWhere('no_so', 'like', "%{$search}%")
                  ->orWhere('catatan', 'like', "%{$search}%");
        }

        $rekapData = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('packing.pages.rekap_so', compact('rekapData', 'search'));
    }

    // [TAG: SIMPAN / IMPORT REKAP SO]
    public function storeRekapSo(Request $request)
    {
        // Jika upload file excel
        if ($request->hasFile('file_excel')) {
            $request->validate([
                'file_excel' => 'required|file|mimes:xlsx,xls,csv|max:10240',
            ]);

            $import = new RekapNoSoImport;
            Excel::import($import, $request->file('file_excel'));

            $inserted = $import->insertedCount;
            $duplicates = $import->duplicates;

            return redirect()->route('pac.rekap_so')
                ->with('import_summary', [
                    'inserted'   => $inserted,
                    'duplicates' => $duplicates,
                ]);
        }

        // Jika input manual 1 data
        $validated = $request->validate([
            'attribute' => 'required|string|max:255',
            'no_so'     => 'required|string|max:255',
            'catatan'   => 'nullable|string',
        ]);

        $attr = trim($validated['attribute']);
        if (RekapNoSo::where('attribute', $attr)->exists()) {
            return redirect()->back()
                ->with('error', "Attribute '{$attr}' sudah ada di Daftar Master Rekap No SO dan tidak dapat ditambahkan kembali.");
        }

        RekapNoSo::create([
            'attribute' => $attr,
            'no_so'     => strtoupper(trim($validated['no_so'])),
            'catatan'   => $validated['catatan'] ? trim($validated['catatan']) : null,
        ]);

        return redirect()->route('pac.rekap_so')
            ->with('success', "Data Attribute '{$attr}' berhasil ditambahkan ke Rekap No SO!");
    }

    // [TAG: HAPUS REKAP SO] Hanya menghapus di tabel rekap_no_sos, tidak berpengaruh ke packing_reports
    public function destroyRekapSo($id)
    {
        $item = RekapNoSo::findOrFail($id);
        $item->delete();

        return redirect()->back()
            ->with('success', 'Data Rekap No SO berhasil dihapus!');
    }

    // [TAG: AJAX CHECK REKAP SO] Lookup attribute untuk autofill no_so & catatan di form tambah packing
    public function checkRekapSo(Request $request)
    {
        $attribute = trim((string)$request->input('attribute'));
        if (empty($attribute)) {
            return response()->json(['found' => false]);
        }

        $rekap = RekapNoSo::where('attribute', $attribute)->first();

        if ($rekap) {
            return response()->json([
                'found'   => true,
                'no_so'   => $rekap->no_so,
                'catatan' => $rekap->catatan ?? '',
            ]);
        }

        return response()->json(['found' => false]);
    }

    // [TAG: TEMPLATE EXCEL REKAP SO] Download format Excel (.xlsx) sesuai template
    public function templateRekapSo()
    {
        return Excel::download(new TemplateRekapNoSoExport, 'Template_Rekap_No_SO.xlsx');
    }

    // [TAG: CLEAR SEMUA REKAP SO] Mengosongkan seluruh tabel rekap_no_sos, packing_reports tidak terpengaruh
    public function clearRekapSo()
    {
        RekapNoSo::truncate();

        return redirect()->route('pac.rekap_so')
            ->with('success', 'Semua data Rekap No SO berhasil dibersihkan!');
    }
}
