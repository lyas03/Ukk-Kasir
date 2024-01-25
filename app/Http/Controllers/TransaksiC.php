<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\MejaM;
use App\Models\ProdukM;
use App\Models\TransaksiM;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransaksiC extends Controller
{
    public function showForm(Request $request)
    {
        $products = ProdukM::all();
        $mejas = MejaM::where('status', 'Tersedia')->get();
        $nomor_unik = str_pad(Carbon::now()->format('YmdHis'), 10, '0', STR_PAD_LEFT);
        $kategori = $request->input('kategori');

        return view('content.transaksi', compact('products', 'nomor_unik', 'mejas', 'kategori'));
    }


    public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required',
        'meja' => 'required',
        'id_produk' => 'required|array',
        'qty' => 'required|array',
        'uang_bayar' => 'required|numeric',
    ]);

    $nomor_unik = str_pad(Carbon::now()->format('YmdHis'), 10, '0', STR_PAD_LEFT);
    $total_harga_transaksi = 0;

    foreach ($request->input('id_produk') as $index => $id_produk) {
        $product = ProdukM::find($id_produk);

        if (!$product) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Produk tidak ditemukan.',
            ]);
        }

        $total_harga = $product->harga_produk * $request->input('qty')[$index];
        $total_harga_transaksi += $total_harga;

        $transaksi = TransaksiM::create([
            'nomor_unik' => $nomor_unik,
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'meja' => $request->input('meja'),
            'id_produk' => $id_produk,
            'nama_barang' => $product->nama_produk,
            'qty' => $request->input('qty')[$index],
            'harga_produk' => $product->harga_produk,
            'total_harga' => $total_harga,
            'uang_bayar' => $request->input('uang_bayar'),
            'uang_kembali' => $request->input('uang_bayar') - $total_harga_transaksi,
        ]);
        
        if (!$transaksi) {
            \Log::error('Gagal menyimpan transaksi: ' . json_encode($request->all()));
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Gagal menyimpan transaksi.',
            ]);
        }
    }

    // Update status meja (asumsi meja terkunci jika sudah ada transaksi)
    $meja = MejaM::find($request->input('meja'));
    $meja->status = 'Tidak Tersedia';
    $meja->save();

    LogM::create([
        'id_user' => auth()->user()->id,
        'activity' => 'Kasir menambahkan transaksi baru',
    ]);

    return redirect()->route('transaksi')->with([
        'success' => true,
        'message' => 'Transaksi berhasil ditambahkan.',
    ]);
}
    public function showHistoryForm()
    {
        $transaction = TransaksiM::all();
        $products = ProdukM::all();

        return view('content.history-transaksi', compact('transaction'));
    }
    
}
