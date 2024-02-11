<div class="modal fade" id="transactionModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display transaction details here -->
                <p><strong>Nomor Unik:</strong> {{ $item->nomor_unik }}</p>
                <p><strong>Nama Pelanggan:</strong> {{ $item->nama_pelanggan }}</p>
                <p><strong>Pilihan Makan:</strong> {{ ucwords(str_replace('_', ' ', $item->pilihan_makan)) }}</p>
                <p><strong>No Meja:</strong> {{ $item->meja }}</p>
                <!-- Display product details -->
                <p><strong>Daftar Produk</strong></p>
                <ul>
                    @php
                        $totalHarga = 0;
                    @endphp
                    @foreach($transactions as $transaction)
                        @if($transaction->id_transaction == $item->id)
                            @php
                                $detailTransaksi = \App\Models\DetailTransaksiM::where('id_transaction', $item->id)->where('id_produk', $transaction->id_produk)->first();
                                $produk = \App\Models\ProdukM::find($transaction->id_produk);
                            @endphp
                            <li>{{ $produk->nama_produk }} - {{ number_format($produk->harga_produk, 0, ',', '.')}} x {{ $transaction->jumlah }}</li>
                            @php
                                $totalHarga = $detailTransaksi->total_harga;
                            @endphp
                        @endif
                    @endforeach
                </ul>
                <p><strong>Total Harga:</strong> Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
                <p><strong>Uang Bayar:</strong> Rp {{ number_format($item->uang_bayar, 0, ',', '.') }}</p>
                <p><strong>Uang Kembali:</strong> Rp {{ number_format($item->uang_kembali, 0, ',', '.') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
