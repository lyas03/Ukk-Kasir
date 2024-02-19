<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Green Eats | @yield('title')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
    <!-- Mengatur font -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Style -->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="d-flex">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo">
                </div>
                <div class="sidebar-brand-text mx-2">Green Eats</div>
            </a>

            <hr class="sidebar-divider my-0">
            @if(Auth::check())
                <a class="sidebar-user d-flex flex-column justify-content-center">
                    <div>Hallo, {{ Auth::user()->nama }}</div>
                    <small>{{ Auth::user()->role }}</small>
                </a>
            @endif


            <!-- Divider -->
            <hr class="sidebar-divider my-0 mb-2">

            <!-- Nav Item - Dashboard -->
            @if(Auth::check())
                @php
                    $userRole = Auth::user()->role;
                @endphp
                @if($userRole == 'admin')
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-solid fa-house-user"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('kategori') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kategori') }}">
                            <i class="fas fa-solid fa-list-ul"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('product') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('product') }}">
                            <i class="fa-solid fa-utensils"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('meja') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('meja') }}">
                            <i class="fas fa-solid fa-chair"></i>
                            <span>Meja</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users') }}">
                            <i class="fas fa-solid fa-users"></i>
                            <span>User</span>
                        </a>
                    </li>
                @elseif($userRole == 'kasir')
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-solid fa-house-user"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('product') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('product') }}">
                            <i class="fa-solid fa-utensils"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('meja') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('meja') }}">
                            <i class="fas fa-solid fa-chair"></i>
                            <span>Meja</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('transaksi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('transaksi.index') }}">
                            <i class="fas fa-solid fa-cash-register"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('history-transaksi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('history.transaksi') }}">
                            <i class="fas fa-solid fa-clock-rotate-left"></i>
                            <span>History Transaksi</span>
                        </a>
                    </li>
                @elseif($userRole == 'owner')
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-solid fa-house-user"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('product') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('product') }}">
                            <i class="fa-solid fa-utensils"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('meja') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('meja') }}">
                            <i class="fas fa-solid fa-chair"></i>
                            <span>Meja</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('history-transaksi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('history.transaksi') }}">
                            <i class="fas fa-solid fa-clock-rotate-left"></i>
                            <span>History Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('log', 'search/log') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('log') }}">
                            <i class="fas fa-solid fa-clipboard-list"></i>
                            <span>Log</span>
                        </a>
                    </li>
                @endif
            @endif
            

            
            <!-- Divider -->
            <hr class="sidebar-divider my-0 mt-2 mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fas fa-solid fa-right-from-bracket"></i>
                    <span>Log out</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @yield('content')
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Green Eats 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset ('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
        function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa  = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
    </script>
    @yield('js')
</body>

</html>