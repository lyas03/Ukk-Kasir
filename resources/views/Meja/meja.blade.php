@extends('layout.layout')

@section('title', 'Meja')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Meja</h1>
        <div class="my-3 d-flex justify-content-start">
            <!-- <a href="book-deleted" class="btn btn-secondary mr-2">
                <i class="fas fa-trash-alt"></i> View Deleted Data
            </a> -->
            <a href="add-meja" class="btn btn-primary">
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
                                <th>NO MEJA</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($meja as $item)
                            <tr>
                                 <td>{{ $counter++ }}</td>
                                <td>{{ $item->no_meja }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('meja.edit', $item->id) }}" class="btn btn-success mr-2">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </a>
                                    <a href="{{ route('meja.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->no_meja }}?')">
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
