@extends('layout.layout')

@section('title', 'Edit Produk')

@section('content')
<div class="container">
        <h2 class="h3 mt-4 mb-4">Edit Produk</h2>
        <form method="post" action="{{ route('product.update', $product->id) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $product->nama_produk }}" required>
            </div>
            <div class="mb-3">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="{{ $product->harga_produk }}" required>
            </div>
        
            <button type="submit" class="btn btn-primary mt-2">Edit Produk</button>
        </form>
    </div>
@endsection