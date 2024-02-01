@extends('layout.layout')

@section('title', 'Produk')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Produk</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataProdukBtn" data-toggle="modal" data-target="#tambahProdukModal">
                <i class="fas fa-plus"></i> Add Data Produk
            </a>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-print"></i> Print Data
                </button>
                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                    <a class="dropdown-item" href="{{ route('product.print', ['kategori' => 'makanan']) }}" target="_blank">Print Data Makanan</a>
                    <a class="dropdown-item" href="{{ route('product.print', ['kategori' => 'minuman']) }}" target="_blank">Print Data Minuman</a>
                    <a class="dropdown-item" href="{{ route('product.print') }}" target="_blank">Print Semua Data</a>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga Produk</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($product as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ ucfirst($item->kategori->nama_kategori) }}</td>
                                <td>{{ $item->harga_produk }}</td>
                                <td>{{ $item->stok }}</td>
                                
                                <td>
                                    <button class="btn btn-success mr-2 btn-edit" data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}" data-harga="{{ $item->harga_produk }}" data-target="#editProdukModal{{ $item->id }}">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </button>
                                    <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama_produk }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
                                    </a>
                                </td>
                            </tr>
                            @include('Product.edit-product', ['item' => $item])
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('Product.add-product')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('addDataProdukBtn').addEventListener('click', function() {
            $('#tambahProdukModal').modal('show');
        });
        $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        var namaProduk = $(this).data('nama');
        var hargaProduk = $(this).data('harga');
        var modalTarget = $(this).data('target');

        // Isi nilai formulir modal
        $(modalTarget).find('input[name="id_produk"]').val(id);
        $(modalTarget).find('#edit_nama_produk').val(namaProduk);
        $(modalTarget).find('#edit_harga_produk').val(hargaProduk);

        // Tampilkan modal
        $(modalTarget).modal('show');
    });
    </script>
@endsection
