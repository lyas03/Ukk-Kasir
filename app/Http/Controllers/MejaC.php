<?php

namespace App\Http\Controllers;

use App\Models\MejaM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MejaC extends Controller
{
    public function meja ()
    {
        $meja = MejaM::all();

        return view('Meja.meja', compact('meja'));
    }
    public function addMejaForm()
    {
        return view('Meja.add-meja');
    }
    public function storeMeja(Request $request)
    {
        $request->validate([
            'no_meja' => [
                'required',
                Rule::unique('meja', 'no_meja'),
            ],
        ]);

        try {
            MejaM::create([
                'no_meja' => $request->input('no_meja'),
                // tambahkan kolom lain jika ada
            ]);

            return redirect()->route('meja')->with('success', 'Berhasil Menambahkan Data');
        } catch (\Exception $e) {
            // Mengecek apakah pesan kesalahan terkait dengan duplikasi kunci
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                return redirect()->route('meja')->with('error', 'Gagal Menambahkan Data. Nomor Meja sudah ada.');
            }

            return redirect()->route('meja')->with('error', 'Gagal Menambahkan Data. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Fetch the user by ID from the database
        $meja = MejaM::findOrFail($id);

        return view('Meja.edit-meja', compact('meja'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_meja' => 'required',
            'status' => 'required',
        ]);
    
        try {
            $meja = MejaM::findOrFail($id);
            $meja->update($validatedData);
    
            return redirect()->route('meja')->with('success', 'Berhasil Update Data');
        } catch (\Exception $e) {
            return redirect()->route('meja')->with('error', 'Gagal Update Data, Mohon Coba Lagi');
        }
    }
    public function deleteMeja($id)
    {
        try {
            $meja = MejaM::findOrFail($id);
            $meja->delete();

            return redirect()->route('meja')->with('success', 'Berhasil Hapus Data');
        } catch (\Exception $e) {
            return redirect()->route('meja')->with('error', 'Gagal Hapus Data, Mohon Coba Lagi');
        }
    }
}
