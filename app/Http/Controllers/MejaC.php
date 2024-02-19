<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use App\Models\LogM;
use App\Models\MejaM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MejaC extends Controller
{
    public function meja ()
    {
        $meja = MejaM::all();
        $userRole = auth()->user()->role;

        return view('Meja.meja', compact('meja','userRole'));
    }
    public function addMejaForm()
    {
        return view('Meja.add-meja');
    }
    public function storeMeja(Request $request)
    {
        try {
            $request->validate([
                'no_meja' => [
                    'required',
                    Rule::unique('meja', 'no_meja'),
                ],
                'jumlah_kursi' => 'required',
            ]);

            MejaM::create([
                'no_meja' => $request->input('no_meja'),
                'jumlah_kursi' => $request->input('jumlah_kursi'),
            ]);

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin menambahkan meja baru",
            ]);

            return redirect()->route('meja')->with('success', 'Berhasil Menambahkan nomor meja');
        } catch (Exception $e) {
            // Tangkap kesalahan umum
            return redirect()->route('meja')->with('error', 'Gagal Menambahkan Nomor Meja');
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
            'jumlah_kursi' => 'required',
            'status' => 'required',
        ]);
    
        try {
            $meja = MejaM::findOrFail($id);
            $noMeja = $meja->no_meja;
            $meja->update($validatedData);

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin melakukan edit meja $noMeja",
            ]);
    
            return redirect()->route('meja')->with('success', "Berhasil Update nomor meja $noMeja");
        } catch (Exception $e) {
            return redirect()->route('meja')->with('error', 'Gagal Update Data, Mohon Coba Lagi');
        }
    }
    public function deleteMeja($id)
    {
        try {
            $meja = MejaM::findOrFail($id);
            $noMeja = $meja->no_meja;
            $meja->delete();

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin menghapus meja $noMeja",
            ]);

            return redirect()->route('meja')->with('success', "Berhasil Hapus nomor meja $noMeja");
        } catch (Exception $e) {
            return redirect()->route('meja')->with('error', 'Gagal Hapus Data, Mohon Coba Lagi');
        }
    }
    public function printMeja()
    {
        $mejas = MejaM::all();

        $jumlah_meja_tersedia = $mejas->where('status', 'Tersedia')->count();
        $jumlah_meja_terpakai = $mejas->where('status', 'Terpakai')->count();

        // Generate PDF
        $pdf = PDF::loadView('Meja.print-meja', compact('mejas', 'jumlah_meja_tersedia', 'jumlah_meja_terpakai'));

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('meja.pdf');
    }
    public function changeStatus($id)
    {
        try {
            // Temukan meja berdasarkan ID
            $meja = MejaM::findOrFail($id);

            // Periksa dan ubah status meja
            if ($meja->status == 'Terpakai') {
                $meja->status = 'Tersedia';
                $noMeja = $meja->no_meja;
                $meja->save();

                LogM::create([
                    'id_user' => auth()->user()->id,
                    'activity' => "Kasir mengubah status meja $noMeja",
                ]);

                return redirect()->route('meja')->with('success', 'Status meja diubah menjadi tersedia.');
            } else {
                // Tambahkan pesan jika status meja tidak valid
                return redirect()->route('meja')->with('error', 'Meja tidak dalam status terpakai.');
            }
        } catch (\Exception $e) {
            // Tambahkan pesan error jika terjadi kesalahan
            return redirect()->route('meja')->with('error', 'Gagal mengubah status meja.');
        }
    }
}
