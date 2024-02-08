<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\KategoriM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriC extends Controller
{
    public function kategori ()
    {
        $kategori = KategoriM::all();

        return view('Kategori.kategori', compact('kategori'));
    }
    public function storeKategori(Request $request)
    {
        try {
            // Validasi data input
            $request->validate([
                'kategori' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('kategori', 'nama_kategori'),
                ],
            ]);
    
            // Simpan data ke database
            KategoriM::create([
                'nama_kategori' => $request->input('kategori'),
            ]);
    
            // Redirect dengan pesan sukses
            return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->route('kategori')->with('error', 'Gagal menambahkan kategori. Mohon coba lagi.');
        }
    }
    public function edit($id_kategori)
    {
        // Fetch the user by ID from the database
        $kategori = KategoriM::findOrFail($id_kategori);

        return view('Kategori.edit-kategori', compact('kategori'));
    }
    public function update(Request $request, $id_kategori)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);
    
        try {
            $kategori = KategoriM::findOrFail($id_kategori);
            $kategori->update($validatedData);
    
            return redirect()->route('kategori')->with('success', 'Berhasil Update Data');
        } catch (Exception $e) {
            return redirect()->route('kategori')->with('error', 'Gagal Update Data, Mohon Coba Lagi');
        }
    }
    public function deleteKategori($id_kategori)
    {
        try {
            $kategori = KategoriM::findOrFail($id_kategori);
            $kategori->delete();

            return redirect()->route('kategori')->with('success', 'Berhasil Hapus Data');
        } catch (Exception $e) {
            return redirect()->route('kategori')->with('error', 'Gagal Hapus Data, Mohon Coba Lagi');
        }
    }
}
