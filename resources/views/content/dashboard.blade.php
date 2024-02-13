@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0">Dashboard</h1>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-utensils"></i></span>
              <div class="info-box-content">
              <a href="{{ route('product') }}">Products</a>
                <span class="info-box-number">
                    {{ $totalProducts }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cart-shopping"></i></span>

              <div class="info-box-content">
              <a href="#" >Transactions</a>
                <span class="info-box-number">
                    {{$totalTransaksi}}
                </span>
              </div>
            </div>
          </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chair"></i></span>

              <div class="info-box-content">
                <a href="{{ route('meja') }}">Meja</a>
                <span class="info-box-number">
                {{ $totalMeja }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
              <a href="{{ route('users') }}" >Users</a>
                <span class="info-box-number">{{ $totalUsers }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="card shadow mb-4">
            <h5 class="mt-3 ml-3 mr-3" style="border-bottom: 1px solid #000;">Transaksi Terbaru</h5>
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
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transactionModal{{ $item->id }}">
                                        <i class="fa-solid fa-circle-info mr-1"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            @include('transaksi.detail')
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection