<?php

namespace App\Http\Controllers;
use App\Exports\SIKExport;
use App\Models\SuratM;
use Carbon\Carbon;
use App\Models\PackingReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PackingController extends Controller
{
    public function index(Request $request)
    {
        $data = PackingReport::orderBy('created_at', 'desc')->get();


        return view('packing.pages.index', compact('data'));
    }

    public function add (){
        return view ('packing.pages.add');
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
        ]);

        // --- SAVE DATA ---


        PackingReport::create($validated);

        // --- SWEET ALERT SUCCESS ---
        // Flash session untuk SweetAlert di blade
        return redirect()->route('pac')
            ->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
{
    // Validasi sesuai field
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
        'label'   => 'required|string',
    ]);

    // Ambil data berdasarkan ID
    $data = PackingReport::findOrFail($id);

    // Update data
    $data->update([
        'date'       => $request->date,
        'attribute'  => $request->attribute,
        'group'      => $request->group,
        'layout'     => $request->layout,
        'no_so'      => $request->no_so,
        'kondisi'    => $request->kondisi,
        'plastik'    => $request->plastik,
        'wrapping'   => $request->wrapping,
        'impraboard' => $request->impraboard,
        'idod'       => $request->idod,
        'pallet'     => $request->pallet,
        'bandazer'   => $request->bandazer,
        'label'   => $request->label,
    ]);

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

}
