<?php

namespace App\Http\Controllers;

use App\Models\CategoryFilter;
use Illuminate\Http\Request;

class KapasitasCategoryFilterController extends Controller
{
    public function index()
    {
        $filters = CategoryFilter::orderBy('kategori')->get();
        return view('modul_kapasitas.user.V_kategori_filter', compact('filters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255'
        ]);

        $kategori = trim($request->input('kategori'));
        
        // Case insensitive uniqueness check
        $exists = CategoryFilter::whereRaw('LOWER(kategori) = ?', [strtolower($kategori)])->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Kategori tersebut sudah ada di daftar filter!');
        }

        CategoryFilter::create([
            'kategori' => $kategori
        ]);

        return redirect()->back()->with('success', 'Filter kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $filter = CategoryFilter::findOrFail($id);
        $filter->delete();

        return redirect()->back()->with('success', 'Filter kategori berhasil dihapus!');
    }
}
