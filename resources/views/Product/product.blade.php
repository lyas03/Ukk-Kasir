@extends('layout.layout')

@section('title', 'Produk')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Produk</h1>
        <div class="my-3 d-flex justify-content-start">
            <!-- <a href="book-deleted" class="btn btn-secondary mr-2">
                <i class="fas fa-trash-alt"></i> View Deleted Data
            </a> -->
            <a href="add-product" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Data
            </a>
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
                                <th>NO</th>
                                <th>NAMA PRODUK</th>
                                <th>KATEGORI</th>
                                <th>HARGA PRODUK</th>
                                <th>AKSI</th>
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
                                <td>
                                    @if($item->kategori === 'makanan')
                                        Makanan
                                    @elseif($item->kategori === 'minuman')
                                        Minuman
                                    @endif
                                </td>
                                <td>{{ $item->harga_produk }}</td>
                                
                                <td>
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-success mr-2">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </a>
                                    <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama_produk }}?')">
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
