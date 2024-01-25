@extends('layout.layout')

@section('title', 'User')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">User</h1>
        <div class="my-3 d-flex justify-content-start">
            <a href="add-user" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Data
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
            <input type="text" id="searchInput" class="form-control mb-2" placeholder="Search">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>USERNAME</th>
                                <th>ROLE</th>
                                <th>AKSI</th>
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
                                <a href="{{ route('users.edit', ['id' => $item->id]) }}" class="btn btn-success mr-2">
                                    <i class="fa-solid fa-pencil mr-2"></i>Edit
                                </a>
                                    <a href="{{ route('users.delete', $item->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus {{ $item->nama }}?')">
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            console.log('Document ready');
            $('#searchInput').on('keyup', function () {
                console.log('Keyup event triggered');
                var searchText = $(this).val().toLowerCase();
                console.log('Search text: ' + searchText);
                filterTable(searchText);
            });
        });

        function filterTable(text) {
            console.log('Filtering table with: ' + text);
            $('#dataTable tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(text) > -1);
            });
        }
    </script>
@endsection
