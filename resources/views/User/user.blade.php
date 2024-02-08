@extends('layout.layout')

@section('title', 'User')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">User</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataUserBtn" data-toggle="modal" data-target="#tambahUserModal">
                <i class="fas fa-plus"></i> Tambah User
            </a>
            <a href="{{ route('users.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-file-pdf"></i> Unduh PDF
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($users as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    @if($item->role === 'admin')
                                        Admin
                                    @elseif($item->role === 'kasir')
                                        Kasir
                                    @elseif($item->role === 'owner')
                                        Owner
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success mr-2 btn-edit" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-username="{{ $item->username }}" data-target="#editUserModal{{ $item->id }}">
                                        <i class="fa-solid fa-pencil mr-2"></i>Edit
                                    </button>
                                    <button class="btn btn-warning mr-2 btn-change" data-id="{{ $item->id }}" data-username="{{ $item->username }}" data-target="#changePasswordModal{{ $item->id }}">
                                        <i class="fa-solid fa-key mr-2"></i>Ganti Password
                                    </button>
                                    <a href="{{ route('users.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                            @include('User.edit-user', ['item' => $item])
                            @include('User.change-password', ['item' => $item])
                        @endforeach
                        </tbody>
                    </table>                  
            </div>
            @include('message.success')
            @include('message.error')
            @foreach($roles as $role)
                @include('User.add-user')
            @endforeach
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
        document.getElementById('addDataUserBtn').addEventListener('click', function() {
            $('#tambahUserModal').modal('show');
        });
        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
            var namaUser = $(this).data('nama');
            var username = $(this).data('username');
            var modalTarget = $(this).data('target');

            // Isi nilai formulir modal
            $(modalTarget).find('input[name="id_user"]').val(id);
            $(modalTarget).find('#edit_nama_user').val(namaUser);
            $(modalTarget).find('#edit_username').val(username);

            // Tampilkan modal
            $(modalTarget).modal('show');
        });
        $(document).on('click', '.btn-change', function () {
            var id = $(this).data('id');
            var username = $(this).data('username');
            var passwordNew = $(this).data('password_new');
            var passwordConfirm = $(this).data('password_confirm');
            var modalTarget = $(this).data('target');

            // Isi nilai formulir modal
            $(modalTarget).find('input[name="id_user"]').val(id);
            $(modalTarget).find('#username').val(username);

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