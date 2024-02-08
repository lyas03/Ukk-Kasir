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
                                <strong>Nomor Unik:</strong> {{ $transaksi->nomor_unik }}
                            </div>

                            <div class="detail-item">
                                <strong>Nama Pelanggan:</strong> {{ $transaksi->nama_pelanggan }}
                            </div>

                            <div class="detail-item">
                                <strong>Meja:</strong> {{ $transaksi->meja }}
                            </div>

                            <div class="detail-item">
                                <strong>ID Produk:</strong> {{ $transaksi->id_produk }}
                            </div>

                            <div class="detail-item">
                                <strong>Total Item:</strong> {{ $transaksi->total_item }}
                            </div>

                            <div class="detail-item">
                                <strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </div>

                            <div class="detail-item">
                                <strong>Uang Bayar:</strong> Rp {{ number_format($transaksi->uang_bayar, 0, ',', '.') }}
                            </div>

                            <div class="detail-item total-label">
                                <strong>Uang Kembali:</strong> Rp {{ number_format($transaksi->uang_kembali, 0, ',', '.') }}
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-flat pull-right mt-3 mr-2" id="transaksiBtn"> Transaksi Baru </button>
                            <a href="{{ route('struk.print') }}" class="btn btn-warning mt-3" target="_blank">
                                Print Struk
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection