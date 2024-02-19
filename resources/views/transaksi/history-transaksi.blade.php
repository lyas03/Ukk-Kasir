@extends('layout.layout')

@section('title', 'History Transaksi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mt-4 mb-3" style="color: black;">History Transaksi</h1>
        <div class="my-3 d-flex justify-content-start">
        @if($userRole === 'owner')
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-pdf"></i> Unduh PDF
                </button>
                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#printByDateModal">Print Berdasarkan Tanggal</a>
                    <a class="dropdown-item" href="{{ route('transaksi.print') }}" target="_blank">Print Semua Transaksi</a>
                </div>
            </div>
        @endif
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Unik</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($transaction as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nomor_unik }}</td>
                                <td>{{ $item->nama_pelanggan }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                                <td>
                                @if($userRole === 'kasir')
                                    <a href="{{ route('struk.print', ['id' => $item->id]) }}" class="btn btn-warning" target="_blank">
                                        Print Struk
                                    </a>
                                @endif
                                @if($userRole === 'owner')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transactionModal{{ $item->id }}">
                                        <i class="fa-solid fa-circle-info mr-1"></i> Detail
                                    </button>
                                @endif
                                </td>
                            </tr>
                            @include('transaksi.detail')
                            @include('transaksi.print-filter')
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
