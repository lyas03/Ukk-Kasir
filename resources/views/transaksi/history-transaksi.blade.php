@extends('layout.layout')

@section('title', 'History Transaksi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">History Transaksi</h1>
        <div class="my-3 d-flex justify-content-start">
            <a href="{{ route('transaksi.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-file-pdf"></i> Unduh PDF
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Unik</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($transaction as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nomor_unik }}</td>
                                <td>{{ $item->nama_pelanggan }}</td>
                                <td>{{ $item->id_produk }}</td>
                                <td>{{ $item->total_item }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-success">
                                        <i class="fa-solid fa-pencil mr-1"></i>Edit
                                    </a>
                                    <a href="{{ route('users.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fas fa-trash-alt mr-1"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
