@extends('layout.layout')

@section('title', 'Log Activity')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">Log Activity</h1>
        <div class="my-3 d-flex justify-content-start">
            <a class="btn btn-primary" onclick="printToPDF()">
                <i class="fas fa-print"></i> Print
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA USER</th>
                                <th>ACTIVITY</th>
                                <th>TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($logs as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->id_user }}</td>
                                <td>{{ ucfirst($item->activity) }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let table = new DataTable('#myTable');

        });
    </script>
@endsection
