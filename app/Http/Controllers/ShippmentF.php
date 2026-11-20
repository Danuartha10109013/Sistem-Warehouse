<?php

namespace App\Http\Controllers;

use App\Exports\ShippmentFTemplate;
use App\Imports\ShippmentFImport;
use App\Models\ShipF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ShippmentF extends Controller
{
    private function routeName(string $name): string
    {
        $role = Auth::user()->role == 0 ? 'admin' : 'pegawai';

        return "Ship-Mark.{$role}.shipment-f{$name}";
    }

    private function rules(): array
    {
        return [
            'no_so' => ['required', 'string', 'max:100'],
            'reference' => ['required', 'string', 'max:100'],
            'destination' => ['required', 'string', 'max:100'],
            'attribute' => ['required', 'string', 'max:100'],
        ];
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $groups = ShipF::query()
            ->when($search !== '', fn ($query) => $query->where('no_so', 'like', "%{$search}%"))
            ->selectRaw('MIN(id) as id, no_so')
            ->groupBy('no_so')
            ->orderBy('no_so')
            ->get();

        return view('pegawai.shippmentf.index', compact('groups', 'search'));
    }

    public function create()
    {
        return view('pegawai.shippmentf.form', ['shipment' => new ShipF]);
    }

    public function store(Request $request)
    {
        ShipF::create($request->validate($this->rules()));

        return redirect()->route($this->routeName(''))->with('success', 'Shipment F berhasil ditambahkan.');
    }

    public function template()
    {
        return Excel::download(new ShippmentFTemplate, 'ShippmentF.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx,xls', 'max:2048']]);
        Excel::import(new ShippmentFImport, $request->file('file'));

        return redirect()->route($this->routeName(''))->with('success', 'Data Shipment F berhasil diimpor.');
    }

    public function show(Request $request, ShipF $shipment)
    {
        $search = $request->input('search', '');
        $data = ShipF::where('no_so', $shipment->no_so)
            ->when($search !== '', fn ($query) => $query->where('reference', 'like', "%{$search}%"))
            ->orderBy('id')->get();

        return view('pegawai.shippmentf.show', compact('shipment', 'data', 'search'));
    }

    public function edit(ShipF $shipment)
    {
        return view('pegawai.shippmentf.form', compact('shipment'));
    }

    public function update(Request $request, ShipF $shipment)
    {
        $shipment->update($request->validate($this->rules()));

        return redirect()->route($this->routeName('-show'), $shipment)->with('success', 'Shipment F berhasil diperbarui.');
    }

    public function destroy(ShipF $shipment)
    {
        $noSo = $shipment->no_so;
        $shipment->delete();
        $remaining = ShipF::where('no_so', $noSo)->first();

        return $remaining
            ? redirect()->route($this->routeName('-show'), $remaining)->with('success', 'Shipment F berhasil dihapus.')
            : redirect()->route($this->routeName(''))->with('success', 'Shipment F berhasil dihapus.');
    }

    public function print(ShipF $shipment)
    {
        $data = ShipF::where('no_so', $shipment->no_so)->orderBy('id')->get();

        return view('pegawai.shippmentf.print', compact('data'));
    }

    public function printOne(ShipF $shipment)
    {
        $data = collect([$shipment]);

        return view('pegawai.shippmentf.print', compact('data'));
    }
}
