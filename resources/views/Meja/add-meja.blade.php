@extends('layout.layout')

@section('title', 'Tambah Meja')

@section('content')
<div class="container">
        <h2 class="h3 mt-4 mb-4">Tambah Meja</h2>
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
        <form method="post" action="{{ route('store.meja') }}">
            @csrf
            <div class="mb-3">
                <label for="no_meja" class="form-label">No Meja</label>
                <input type="number" class="form-control" id="no_meja" name="no_meja" required>
            </div>
        
            <button type="submit" class="btn btn-primary mt-2">Tambah Meja</button>
        </form>
    </div>
@endsection