@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0">Dashboard</h1>
        </div>

        <div class="row">
            <!-- Card for Products -->
            <div class="col-xl-4 mb-4">
                <a href="{{ route('product') }}" class="card border-left py-2 rounded-right text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Produk</div>
                                <div class="text-lg mb-0 font-weight-bold">{{ $totalProducts }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-boxes-stacked fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card for Tables -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('meja') }}" class="card border-left py-2 rounded-right text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Meja</div>
                                <div class="text-lg mb-0 font-weight-bold">{{ $totalMeja }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-chair fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card for Users -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('users') }}" class="card border-left py-2 rounded-right text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    User</div>
                                <div class="text-lg mb-0 font-weight-bold">{{ $totalUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-user fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection