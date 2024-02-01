@extends('layout.layout')

@section('title', 'Meja')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Meja</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataMejaBtn" data-toggle="modal" data-target="#tambahMejaModal">
                <i class="fas fa-plus"></i> Add Data Meja
            </a>
            <a href="{{ route('meja.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Print Data
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
                                    <button class="btn btn-success mr-2 btn-edit" data-id="{{ $item->id }}" data-meja="{{ $item->no_meja }}" data-status="{{ $item->status }}" data-target="#editMejaModal{{ $item->id }}">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </button>
                                    <a href="{{ route('meja.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->no_meja }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
                                    </a>
                                </td>
                            </tr>
                            @include('Meja.edit-meja', ['item' => $item])
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('Meja.add-meja')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('addDataMejaBtn').addEventListener('click', function() {
            $('#tambahMejaModal').modal('show');
        });
        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
            var meja = $(this).data('meja');
            var status = $(this).data('status');
            var modalTarget = $(this).data('target');

            // Isi nilai formulir modal
            $(modalTarget).find('input[name="id"]').val(id);
            $(modalTarget).find('#edit_no_meja').val(meja);
            $(modalTarget).find('#edit_status').val(status);

            // Tampilkan modal
            $(modalTarget).modal('show');
        });
    </script>
@endsection
