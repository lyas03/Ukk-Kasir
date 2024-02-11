@extends('layout.layout')

@section('title', 'Produk')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Produk</h1>
        @if($userRole === 'admin')
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataProdukBtn" data-toggle="modal" data-target="#tambahProdukModal">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-pdf"></i> Unduh PDF
                </button>
                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                    @foreach($kategories as $kategori)
                        <a class="dropdown-item" href="{{ route('product.print', ['kategori' => $kategori->nama_kategori]) }}" target="_blank">Print Kategori {{ $kategori->nama_kategori }}</a>
                    @endforeach
                    <a class="dropdown-item" href="{{ route('product.print') }}" target="_blank">Print Semua Kategori</a>
                </div>
            </div>
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
                                @if($userRole === 'admin')
                                    <th>Aksi</th>
                                @endif
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

                                @if($userRole === 'admin')
                                <td>
                                    <button class="btn btn-success mr-2 btn-edit" data-id="{{ $item->id_produk }}" data-nama="{{ $item->nama_produk }}" data-harga="{{ $item->harga_produk }}" data-target="#editProdukModal{{ $item->id_produk }}">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </button>
                                    <a href="{{ route('product.delete', $item->id_produk) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama_produk }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @include('Product.edit-product', ['item' => $item])
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('message.success')
                @include('message.error')
                @include('Product.add-product')
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
        $(document).ready(function() {
            // Cek apakah ada pesan success dari response JSON
            @if(session('success'))
                $('#successModal').modal('show');
            @endif
            // Cek apakah ada pesan error dari response JSON
            @if(session('error'))
                $('#errorModal').modal('show');
            @endif

            // Event listener for the "Tutup" button inside the success modal
            $('#successModal button[data-bs-dismiss="modal"]').on('click', function () {
                $('#successModal').modal('hide');
            });
            $('#errorModal button[data-bs-dismiss="modal"]').on('click', function () {
                $('#errorModal').modal('hide');
            });
        });
        $(document).ready(function(){
            $('.dropdown-toggle').dropdown();
        });
        
    </script>
@endsection
