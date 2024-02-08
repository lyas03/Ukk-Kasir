@extends('layout.layout')

@section('title', 'Log Activity')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Log Activity</h1>
        <button type="button" class="btn btn-primary mb-4" id="searchBtn" data-toggle="modal" data-target="#dateSearchModal">
                <i class="fa-solid fa-magnifying-glass mr-2"></i>Cari Berdasarkan Tanggal
            </button>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Activity</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($logs as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ ucfirst($item->activity) }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('Log.log-search')
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('searchBtn').addEventListener('click', function() {
            $('#dateSearchModal').modal('show');
        });
    </script>
@endsection
