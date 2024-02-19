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
        $products = ProdukM::where('status', 'Tersedia')->get();
        $randomNumber = mt_rand(1000000000, 9999999999);
        $meja = MejaM::where('status', 'Tersedia')->get();

        return view('transaksi.transaksi', compact('products', 'meja','randomNumber'));
    }
    public function store(Request $request)
    {
        try {
        $nomor_unik = $request->input('nomor_unik');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $pilihan_makan = $request->input('pilihan_makan');
        $meja = $request->input('meja');
        if ($pilihan_makan === 'makan_di_tempat' && !$meja) {
            return redirect()->route('transaksi.index')->with('error', 'No Meja harus dipilih untuk Makan di Tempat.');
        }
        if ($meja) {
            // Cek apakah rekaman MejaM dengan no_meja yang diberikan ada sebelum mengubah status
            $mejaObj = MejaM::where('no_meja', $meja)->first();
            
            if ($mejaObj) {
                $mejaObj->status = 'Terpakai';
                $mejaObj->save();
            } else {
                // Handle kasus ketika rekaman MejaM tidak ditemukan
                return redirect()->route('transaksi.index')->with('error', 'Tidak ada rekaman MejaM yang sesuai ditemukan.');
            }
        }
        $sub_total = $request->input('sub_total');
        $uang_bayar = $request->input('uang_bayar');
        if ($uang_bayar < $sub_total) {
            return redirect()->route('transaksi.index')->with('error', 'Uang Bayar Kurang');
        }
        $uang_kembali = $request->input('uang_kembali');

        $transaksi = new TransaksiM();
        $transaksi->fill([
            'nomor_unik' => $nomor_unik,
            'nama_pelanggan' => $nama_pelanggan,
            'pilihan_makan' => $pilihan_makan,
            'meja' => $meja,
            'sub_total' => $sub_total,
            'uang_bayar' => $uang_bayar,
            'uang_kembali' => $uang_kembali
        ]);
        $transaksi->save();

        foreach ($request->get('id_produk') as $index => $id_produk) {
            $product = ProdukM::findOrFail($id_produk);
            $detail_transaksis = new DetailTransaksiM();
            $detail_transaksis->fill([
                "id_transaction" => $transaksi->id,
                "id_produk" => $id_produk,
                "harga_produk" => $product->harga_produk,
                "jumlah" => $request->get('quantity')[$index], // Use $index to access the corresponding quantity
                "total_harga" => $product->harga_produk * $request->get('quantity')[$index] // Use $index here as well
            ]);
            $detail_transaksis->save();
        }

        $newTransaksi = TransaksiM::with('produk')->latest()->first();

        LogM::create([
            'id_user' => auth()->user()->id,
            'activity' => "Kasir melakukan transaksi baru",
        ]);

        // Redirect to the selesai route
        return redirect()->route('transaksi.selesai', ['transaksi' => $newTransaksi->id])->with('success', 'Transaksi Berhasil Ditambah');
    } catch (\Exception $e) {
        dd($e->getMessage());
        // Handle other exceptions here if needed
        return redirect()->route('transaksi.index')->with('error', 'Transaksi Gagal, Mohon coba lagi.');
    }
}
    public function selesai($transaksi)
    {
        $transaksiData = TransaksiM::with('produk')->findOrFail($transaksi);

        // Tampilkan view transaksi_selesai dengan menyertakan data transaksi
        return view('transaksi.transaksi-selesai', compact('transaksiData'));
    }
    public function printStruk($id)
    {
        $transaksiData = TransaksiM::with('detailTransaksis.produk')->findOrFail($id);
        $struk = [0,0,164,310];

        $pdf = PDF::loadView('transaksi.struk', compact('transaksiData'))
                ->setPaper($struk, 'portrait');

                LogM::create([
                    'id_user' => auth()->user()->id,
                    'activity' => "Kasir melakukan print struk",
                ]);

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('struk.pdf');
    }

    public function showHistoryForm()
    {
        $transaction = TransaksiM::all();
        $userRole = auth()->user()->role;
        $transactions = DetailTransaksiM::with(['transaksi', 'produk'])
        ->select('id_transaction', 'id_produk', 'jumlah','total_harga')
        ->get();

        return view('transaksi.history-transaksi', compact('transaction','transactions','userRole'));
    }
    public function printTransaksi()
    {
        $transaction = TransaksiM::all();
        $transactions = DetailTransaksiM::with(['transaksi', 'produk'])
        ->select('id_transaction', 'id_produk', 'jumlah','total_harga')
        ->get();

        $setPdf =['0','0','595.27','841.88'];
        // Generate PDF
        $pdf = PDF::loadView('transaksi.print-transaksi', compact('transaction','transactions'))
                ->setPaper($setPdf, 'portrait');

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('transaksi.pdf');
    }
    public function printByDate(Request $request)
    {
        $start_date = $request->input('start_date') . ' 00:00:00';
        $end_date = $request->input('end_date') . ' 23:59:59';

        // Query transaksi berdasarkan rentang tanggal
        $transactions = DetailTransaksiM::with(['transaksi', 'produk'])
            ->whereHas('transaksi', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('created_at', [$start_date, $end_date]);
            })
            ->select('id_transaction', 'id_produk', 'jumlah', 'total_harga')
            ->get();

        // Tambahkan filter untuk transaksi juga
        $transaction = TransaksiM::whereBetween('created_at', [$start_date, $end_date])->get();

        $setPdf = ['0', '0', '595.27', '841.88'];

        // Generate PDF
        $pdf = PDF::loadView('transaksi.print-transaksi', compact('transactions', 'transaction'))
            ->setPaper($setPdf, 'portrait');

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('transaksi.pdf');
    }
    public function deleteTransaksi($id)
    {
        try {
            // Find the transaction record by id
            $transaction = TransaksiM::findOrFail($id);
            $namaTransaksi = $transaction->nama_pelanggan;

            // Retrieve the related details_transaksis and delete them
            $transaction->detailTransaksis()->delete();

            // Delete the transaction record
            $transaction->delete();

            LogM::create([
                'id_user' => auth()->user()->id,
                'activity' => "Admin menghapus transaksi $namaTransaksi",
            ]);

            return redirect()->route('history.transaksi')->with('success', 'Berhasil Hapus Data');
        } catch (Exception $e) {
            return redirect()->route('history.transaksi')->with('error', 'Gagal Hapus Data, Mohon Coba Lagi');
        }
    }
}
