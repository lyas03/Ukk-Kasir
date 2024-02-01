<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriM;

class KategoriC extends Controller
{
    public function kategori ()
    {
        $kategori = KategoriM::all();

        return view('Kategori.kategori', compact('kategori'));
    }
    public function storeKategori(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        KategoriM::create([
            'nama_kategori' => $request->input('kategori'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }
}
