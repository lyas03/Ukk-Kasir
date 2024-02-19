<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LogM;
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

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => 'Admin menambahkan kategori baru',
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
            $namaKategori = $kategori->nama_kategori;
            $kategori->update($validatedData);

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin melakukan edit kategori $namaKategori",
            ]);

            return redirect()->route('kategori')->with('success', "Berhasil Update Kategori $namaKategori");
        } catch (Exception $e) {
            return redirect()->route('kategori')->with('error', 'Gagal Update Kategori, Mohon Coba Lagi');
        }
    }
    public function deleteKategori($id_kategori)
    {
        try {
            $kategori = KategoriM::findOrFail($id_kategori);
            $namaKategori = $kategori->nama_kategori;
            $kategori->delete();

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin menghapus kategori $namaKategori",
            ]);

            return redirect()->route('kategori')->with('success', "Berhasil Hapus Kategori $namaKategori");
        } catch (Exception $e) {
            return redirect()->route('kategori')->with('error', 'Gagal Hapus Kategori, Mohon Coba Lagi');
        }
    }
}
