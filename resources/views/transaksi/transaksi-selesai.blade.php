@extends('layout.layout')

@section('title', 'Transaksi')

@section('content')
    <div class="container">
        <h2 class="h3 mt-4 mb-3">Transaksi Berhasil</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                        <form class="form-user" action="{{ route('transaksi.index') }}" method="get">
                            <div class="detail-item">
                                <strong>Nomor Unik:</strong> {{ $transaksiData->nomor_unik }}
                            </div>

                            <div class="detail-item">
                                <strong>Nama Pelanggan:</strong> {{ $transaksiData->nama_pelanggan }}
                            </div>
                            <div class="detail-item">
                                <strong>Pilihan Makan:</strong> {{ ucwords(str_replace('_', ' ', $transaksiData->pilihan_makan)) }}
                            </div>

                            <div class="detail-item">
                                <strong>Meja:</strong> {{ $transaksiData->meja ? $transaksiData->meja : '-' }}
                            </div>

                            <div class="detail-item">
                                <strong>Produk:</strong>
                                <ul>
                                @foreach($transaksiData->detailTransaksis as $detailTransaksi)
                                    @php
                                        $produk = \App\Models\ProdukM::find($detailTransaksi->id_produk);
                                    @endphp
                                    <li> {{ $produk->nama_produk }} x {{ $detailTransaksi->jumlah }}</li>
                                @endforeach
                                </ul>
                            </div>

                            <div class="detail-item">
                                <strong>Sub Total:</strong>
                                    Rp {{ number_format($transaksiData->sub_total, 0, ',', '.') }}, 
                            </div>

                            <div class="detail-item">
                                <strong>Uang Bayar:</strong>
                                    Rp {{ number_format($transaksiData->uang_bayar, 0, ',', '.') }}, 
                            </div>

                            <div class="detail-item total-label">
                                <strong>Uang Kembali:</strong>
                                    Rp {{ number_format($transaksiData->uang_kembali, 0, ',', '.') }}, 
                            </div>

                            <button type="submit" class="btn btn-primary btn-md btn-flat pull-right mt-3 mr-2" id="transaksiBtn"> Transaksi Baru </button>
                            <a href="{{ route('struk.print', ['id' => $transaksiData->id]) }}" class="btn btn-warning mt-3" target="_blank">
                                Print Struk
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
