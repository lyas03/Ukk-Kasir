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
        $products = ProdukM::where('stok', '>', 0)->get();
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

        $uang_bayar = $request->input('uang_bayar');
        $uang_kembali = $request->input('uang_kembali');

        $transaksi = new TransaksiM();
        $transaksi->fill([
            'nomor_unik' => $nomor_unik,
            'nama_pelanggan' => $nama_pelanggan,
            'pilihan_makan' => $pilihan_makan,
            'meja' => $meja,
            'uang_bayar' => $uang_bayar,
            'uang_kembali' => $uang_kembali
        ]);
        $transaksi->save();

        $no_products = 0;
        foreach ($request->get('id_produk') as $id_produk) {
            $products = ProdukM::findOrFail($id_produk);
            $detail_transaksis = new DetailTransaksiM();
            $detail_transaksis->fill([
                "id_transaction" => $transaksi->id,
                "id_produk" => $id_produk,
                "harga_produk" => $products->harga_produk,
                "jumlah" => $request->get('quantity')[$no_products], // Corrected from 'jumlah' to 'quantity'
                "total_harga" => $request->get('total_harga')
            ]);
            $detail_transaksis->save();

            $products->stok -= $request->get('quantity')[$no_products];
            $products->save();
            $no_products++;
        }

        $newTransaksi = TransaksiM::with('produk')->latest()->first();

        // Redirect to the selesai route
        return redirect()->route('transaksi.selesai', ['transaksi' => $newTransaksi->id])->with('success', 'Transaksi Berhasil Ditambah');
    } catch (\Exception $e) {
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
        $struk = [0,0,226.77,396.85];

        $pdf = PDF::loadView('transaksi.struk', compact('transaksiData'))
                ->setPaper($struk, 'portrait');

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

            // Retrieve the related details_transaksis and delete them
            $transaction->detailTransaksis()->delete();

            // Delete the transaction record
            $transaction->delete();

            return redirect()->route('history.transaksi')->with('success', 'Berhasil Hapus Data');
        } catch (Exception $e) {
            return redirect()->route('history.transaksi')->with('error', 'Gagal Hapus Data, Mohon Coba Lagi');
        }
    }
    public function editTransaksi($id)
    {
        try {
            // Mengambil data transaksi berdasarkan ID
            $transaksi = TransaksiM::findOrFail($id);
            $transaksiData = TransaksiM::with('detailTransaksis.produk')->findOrFail($id);

            $nomorUnik = $transaksi->nomor_unik;
            $meja = MejaM::all();

            // Mengambil semua produk untuk dropdown di form
            $products = ProdukM::with('detailTransaksi')->get();

            // Mengirim data ke view edit
            return view('transaksi.edit-transaksi', compact('transaksi', 'products','nomorUnik','meja','transaksiData'));

        } catch (Exception $e) {
            // Menangani jika terjadi kesalahan
            return redirect()->route('history.transaksi')->with('error', 'Gagal Mengambil Data Transaksi, Mohon Coba Lagi');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Validasi request jika diperlukan

            // Mengambil data transaksi berdasarkan ID
            $transaksi = TransaksiM::findOrFail($id);

            // Mengupdate data transaksi sesuai dengan data yang diterima dari request
            $transaksi->update([
                'nomor_unik' => $request->input('nomor_unik'),
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'meja' => $request->input('meja'),
                'uang_bayar' => $request->input('uang_bayar'),
                'uang_kembali' => $request->input('uang_kembali'),
            ]);

            // Menghapus semua detail transaksi yang terkait
            $transaksi->detailTransaksis()->delete();

            // Menyimpan kembali detail transaksi yang baru
            $this->saveDetailTransaksi($transaksi, $request->input('id_produk'), $request->input('quantity'));

            return redirect()->route('history.transaksi')->with('success', 'Berhasil Update Data Transaksi');

        } catch (Exception $e) {
            // Menangani jika terjadi kesalahan
            return redirect()->route('history.transaksi')->with('error', 'Gagal Update Data Transaksi, Mohon Coba Lagi');
        }
    }
    private function saveDetailTransaksi($transaksi, $produkIds, $quantities)
    {
        foreach ($produkIds as $key => $produkId) {
            // Menyimpan setiap detail transaksi
            DetailTransaksiM::create([
                'transaction_id' => $transaksi->id,
                'produk_id' => $produkId,
                'quantity' => $quantities[$key],
            ]);
        }
    }


}
