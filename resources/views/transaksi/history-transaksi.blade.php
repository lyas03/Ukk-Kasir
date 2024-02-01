@extends('layout.layout')

@section('title', 'History Transaksi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">History Transaksi</h1>
        <div class="my-3 d-flex justify-content-start">
            <a href="{{ route('transaksi.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Print Data
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA PELANGGAN</th>
                                <th>NAMA PRODUK</th>
                                <th>MEJA</th>
                                <th>TANGGAL</th>
                                <th>QTY</th>
                                <th>SUB TOTAL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($transaction as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama_pelanggan }}</td>
                                <td>{{ $item->id_produk }}</td>
                                <td>{{ $item->meja }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->sub_total }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-success mr-2">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </a>
                                    <a href="{{ route('users.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
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
