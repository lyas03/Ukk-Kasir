@extends('layout.layout')

@section('title', 'Kategori')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Kategori</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataBtn" data-toggle="modal" data-target="#addKategoriModal">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
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
                    @php
                        $counter = 1;
                    @endphp
                        @foreach($kategori as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <button class="btn btn-success mr-2 btn-edit" data-id_kategori="{{ $item->id_kategori }}" data-nama_kategori="{{ $item->nama_kategori }}" data-target="#editKategoriModal{{ $item->id_kategori }}">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </button>
                                    <a href="{{ route('kategori.delete', $item->id_kategori) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama_kategori }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                            @include('Kategori.edit-kategori')
                        @endforeach
                    </tbody>
                </table>           
            </div>
            @include('message.success')
            @include('message.error')
            @include('Kategori.add-kategori') 
        </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('addDataBtn').addEventListener('click', function() {
            $('#tambahKategoriModal').modal('show');
        });
        $(document).on('click', '.btn-edit', function () {
            var id_kategori = $(this).data('id_kategori');
            var nama_kategori = $(this).data('nama_kategori');
            var modalTarget = $('#editKategoriModal' + id_kategori);

            // Isi nilai formulir modal
            modalTarget.find('input[name="id_kategori"]').val(id_kategori);
            modalTarget.find('#edit_nama_kategori').val(nama_kategori);

            // Tampilkan modal
            modalTarget.modal('show');
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
