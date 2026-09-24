<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterProduct;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MasterProductImport;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MasterProductController extends Controller
{
    // [TAG: HALAMAN UTAMA]
    public function index(Request $request)
    {
        $query = MasterProduct::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('search_key', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
        }

        $data = $query->paginate(10);

        if ($request->ajax()) {
            return view('master_product.partials.table', compact('data'))->render();
        }

        return view('master_product.index', compact('data'));
    }

    // [TAG: SIMPAN MANUAL]
    public function store(Request $request)
    {
        $request->validate([
            'search_key' => 'required|unique:master_products,search_key',
            'name' => 'required|string',
        ]);

        MasterProduct::create([
            'search_key' => $request->search_key,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    // [TAG: UPDATE MANUAL]
    public function update(Request $request, $id)
    {
        $request->validate([
            'search_key' => 'required|unique:master_products,search_key,'.$id,
            'name' => 'required|string',
            'foto' => 'nullable|image|max:10240'
        ]);

        $product = MasterProduct::findOrFail($id);
        
        $data = [
            'search_key' => $request->search_key,
            'name' => $request->name,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($file->getRealPath());
            $encoded = $image->toWebp(80);
            $filename = 'master_products/' . $request->search_key . '_' . time() . '.webp';
            
            \Illuminate\Support\Facades\Storage::disk('public')->put($filename, (string) $encoded);
            
            if ($product->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->foto);
            }
            $data['foto'] = $filename;
        } elseif ($request->has('hapus_foto') && $request->hapus_foto == '1') {
            if ($product->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->foto);
            }
            $data['foto'] = null;
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Produk berhasil diupdate.');
    }

    // [TAG: IMPORT EXCEL]
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120'
        ]);

        Excel::import(new MasterProductImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data produk berhasil diimport.');
    }

    // [TAG: HAPUS]
    public function destroy($id)
    {
        $product = MasterProduct::findOrFail($id);
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }

    // [TAG: CHECK QR KEY]
    public function checkSearchKey(Request $request)
    {
        $key = $request->input('search_key');
        $product = MasterProduct::where('search_key', $key)->first();

        if ($product) {
            return response()->json(['exists' => true, 'id' => $product->id, 'name' => $product->name, 'search_key' => $product->search_key]);
        }
        return response()->json(['exists' => false]);
    }

    // [TAG: UPLOAD FOTO]
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:master_products,id',
            'foto' => 'required|image|max:10240' // max 10MB input allowed, will be compressed
        ]);

        try {
            $product = MasterProduct::findOrFail($request->id);
            $file = $request->file('foto');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            
            // Konversi ke webp dengan kualitas 80
            $encoded = $image->toWebp(80);
            $filename = 'master_products/' . $product->search_key . '_' . time() . '.webp';
            
            Storage::disk('public')->put($filename, (string) $encoded);

            // Hapus foto lama jika ada
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }

            $product->foto = $filename;
            $product->save();

            return response()->json(['success' => true, 'foto_url' => asset('storage/' . $filename)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
