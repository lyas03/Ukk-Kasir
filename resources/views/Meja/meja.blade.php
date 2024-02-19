@extends('layout.layout')

@section('title', 'Meja')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Meja</h1>
        @if($userRole === 'admin')
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataMejaBtn" data-toggle="modal" data-target="#tambahMejaModal">
                <i class="fas fa-plus"></i> Tambah No Meja
            </a>
        </div>
        @endif
        @if($userRole === 'owner')
        <div class="my-3 d-flex justify-content-start">
            <a href="{{ route('meja.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-file-pdf"></i> Unduh PDF
            </a>
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Meja</th>
                                <th>Jumlah Kursi</th>
                                <th>Status</th>
                                @if(in_array($userRole, ['admin', 'kasir']))
                                <th>Aksi</th>
                                @endif
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
                                <td>{{ $item->jumlah_kursi }}</td>
                                <td>
                                    @if($item->status == 'Tersedia')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif($item->status == 'Terpakai')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                @if(in_array($userRole, ['admin', 'kasir']))
                                <td>
                                    @if($userRole === 'kasir')
                                    <form action="{{ route('meja.change', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa-solid fa-arrows-rotate"></i> Ubah Status
                                        </button>
                                        @include('message.success')
                                        @include('message.error')
                                    </form>
                                    @endif
                                    @if($userRole === 'admin')
                                    <button class="btn btn-success mr-2 btn-edit" data-id="{{ $item->id }}" data-meja="{{ $item->no_meja }}" data-kursi="{{ $item->jumlah_kursi }}" data-status="{{ $item->status }}" data-target="#editMejaModal{{ $item->id }}">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </button>
                                    <a href="{{ route('meja.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus nomor meja {{ $item->no_meja }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus
                                    </a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @include('Meja.edit-meja', ['item' => $item])
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('message.success')
                @include('message.error')
                @include('Meja.add-meja')
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $('#addDataMejaBtn').on('click', function() {
            $('#tambahMejaModal').modal('show');
        });
        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
            var meja = $(this).data('meja');
            var kursi = $(this).data('kursi');
            var status = $(this).data('status');
            var modalTarget = $(this).data('target');

            // Isi nilai formulir modal
            $(modalTarget).find('input[name="id"]').val(id);
            $(modalTarget).find('#edit_no_meja').val(meja);
            $(modalTarget).find('#edit_jumlah_kursi').val(kursi);
            $(modalTarget).find('#edit_status').val(status);

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
    </script>
@endsection
