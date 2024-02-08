<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\LogM;
use App\Models\MejaM;
use App\Models\ProdukM;
use App\Models\TransaksiM;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailTransaksiM;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransaksiC extends Controller
{
    public function index()
    {   
        $products = ProdukM::orderBy('nama_produk')->get();
        $randomNumber = mt_rand(1000000000, 9999999999);
        $meja = MejaM::where('status', 'Tersedia')->get();

        return view('transaksi.transaksi', compact('products', 'meja','randomNumber'));
    }

    public function showForm(Request $request)
    {
        $products = ProdukM::orderBy('nama_produk')->get();
        $mejas = MejaM::where('status', 'Tersedia')->get();
        $id_transaksi = TransaksiM::where('id_transaksi')->get();

        return view('transaksi.transaksi', compact('products', 'mejas','id_transaksi'));
    }
    public function store(Request $request)
    {
        try {
            // Validasi data yang diterima dari formulir
            $request->validate([
                // Sesuaikan dengan kolom-kolom di tabel transaksi
                'nomor_unik' => 'required',
                'nama_pelanggan' => 'required',
                'meja' => 'nullable',
                'id_produk' => 'required',
                'total_item' => 'required|numeric|min:1',
                'total_harga' => 'required|numeric|min:0',
                'uang_bayar' => 'required|numeric|min:0',
                'uang_kembali' => 'required|numeric|min:0',
            ]);

            // Simpan data transaksi ke database
            $transaksi = TransaksiM::create($request->all());

            return redirect()->route('transaksi.selesai', compact('transaksi'));
        } catch (\Exception $e) {
            // Handle kesalahan jika terjadi
            return redirect()->route('transaksi.index')->with('error', 'Gagal melakukan transaksi');
        }
    }

    public function selesai()
    {
        $transaksi = TransaksiM::with('produk')->latest()->first();

        // Tampilkan view transaksi_selesai dengan menyertakan data transaksi
        return view('transaksi.transaksi-selesai', compact('transaksi'));
    }  
    public function printStruk()
    {
        $transaksi = TransaksiM::with('produk')->latest()->first();
        $pdf = PDF::loadView('transaksi.struk', compact('transaksi'));
        
        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('struk.pdf');
    }

    public function showHistoryForm()
    {
        $transaction = TransaksiM::all();
        $products = ProdukM::all();

        return view('transaksi.history-transaksi', compact('transaction'));
    }
    public function printTransaksi()
    {
        $transaction = TransaksiM::all();

        // Generate PDF
        $pdf = PDF::loadView('transaksi.print-transaksi', compact('transaction'));

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('transaksi.pdf');
    }

}
