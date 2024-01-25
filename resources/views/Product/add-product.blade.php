@extends('layout.layout')

@section('title', 'Produk')

@section('content')
<div class="container">
        <h2 class="h3 mt-4 mb-4">Tambah Produk</h2>
        <form method="post" action="{{ route('store.product') }}">
            @csrf
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <div style="display: flex; gap: 10px;">
                    @foreach($kategoris as $key => $kategori)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="{{ $kategori }}" value="{{ $kategori }}" required>
                            <label class="form-check-label" for="{{ $kategori }}">
                                {{ ucfirst($kategori) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
            </div>
        
            <button type="submit" class="btn btn-primary mt-2">Tambah Produk</button>
        </form>
    </div>
@endsection