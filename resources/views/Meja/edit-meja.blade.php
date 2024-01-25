@extends('layout.layout')

@section('title', 'Edit Meja')

@section('content')
<div class="container">
        <h2 class="h3 mt-4 mb-4">Edit Meja</h2>
        <form method="post" action="{{ route('meja.update', $meja->id) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="no_meja" class="form-label">No Meja</label>
                <input type="text" class="form-control" id="no_meja" name="no_meja" value="{{ $meja->no_meja }}" readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Tersedia" {{ $meja->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Tidak Tersedia" {{ $meja->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Edit Meja</button>
        </form>
    </div>
@endsection