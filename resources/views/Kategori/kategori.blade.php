@extends('layout.layout')

@section('title', 'kategori')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">kategori</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataBtn" data-toggle="modal" data-target="#addDataModal">
                <i class="fas fa-plus"></i> Add Data
            </a>
            <a href="{{ route('users.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Print Data
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-hide">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-hide">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <!-- Tambahkan tombol aksi sesuai kebutuhan -->
                                    <!-- Misalnya, tombol untuk mengedit atau menghapus kategori -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>           
            </div>
            @include('Kategori.form') 
        </div>
</div>
<script>
    document.getElementById('addDataBtn').addEventListener('click', function() {
    });
</script>
@endsection
