@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0">Dashboard</h1>
        </div>
        <div class="row">
          @if(in_array($userRole, ['admin', 'kasir','owner']))
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-utensils"></i></span>
              <div class="info-box-content">
              <a>Products</a>
                <span class="info-box-number">
                    {{ $totalProducts }}
                    <small>Produk</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-chair"></i></span>
              
              <div class="info-box-content">
                <a>Meja</a>
                <span class="info-box-number">
                  {{ $totalMeja }}
                  <small>Meja</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          @if($userRole == 'admin')
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-solid fa-list-ul"></i></span>
              
              <div class="info-box-content">
                <a>Kategori</a>
                <span class="info-box-number">{{ $totalKategori }}
                  <small>Kategori</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              
              <div class="info-box-content">
                <a>Users</a>
                <span class="info-box-number">{{ $totalUsers }}
                  <small>User</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          @if(in_array($userRole, ['owner','kasir']))
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cart-shopping"></i></span>

              <div class="info-box-content">
              <a>Transactions</a>
                <span class="info-box-number">
                    {{$totalTransaksi}}
                    <small>Transaksi</small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-money-bill-wave"></i></span>

              <div class="info-box-content">
              <a href="{{ route('users') }}" >Pendapatan</a>
                <span class="info-box-number">{{ number_format($pendapatan, 0, ',', '.') }}
                  <small>Rupiah</small>
                </span>
              </div>
            </div>
          </div>
          @endif
          <!-- /.col -->
        </div>
        <div class="card shadow mb-4">
            <h5 class="mt-3 ml-3 mr-3" style="border-bottom: 1px solid #000;">Daftar Produk</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga Produk</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach($product as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->status == 'Tersedia')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif($item->status == 'Habis')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection