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

class TransaksiC extends Controller
{
    public function showForm(Request $request)
    {
        $products = ProdukM::orderBy('nama_produk')->get();
        $mejas = MejaM::where('status', 'Tersedia')->get();

        return view('transaksi.transaksi', compact('products', 'mejas'));
    }
    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->id_penjualan);
        $penjualan->id_member = $request->id_member;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->diterima = $request->diterima;
        $penjualan->update();

        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = Produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('transaksi.selesai');
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
