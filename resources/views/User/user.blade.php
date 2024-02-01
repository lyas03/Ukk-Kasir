@extends('layout.layout')

@section('title', 'User')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">User</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary mr-3" id="addDataUserBtn" data-toggle="modal" data-target="#tambahUserModal">
                <i class="fas fa-plus"></i> Add Data User
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
                                    <a href="{{ route('users.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama }}?')">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
                                    </a>
                                </td>
                            </tr>
                            @include('User.edit-user', ['item' => $item])
                        @endforeach
                        </tbody>
                    </table>                  
            </div>
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
</script>
@endsection