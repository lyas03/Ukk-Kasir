<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Big Food | @yield('title')</title>

    <!-- Mengatur font -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Style -->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="d-flex">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Big Food</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            @if(Auth::check())
                <a class="sidebar-user d-flex flex-column justify-content-center">
                    <div>Hallo, {{ Auth::user()->nama }}</div>
                    <small>{{ Auth::user()->role }}</small>
                </a>
            @endif


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if(Auth::check())
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="dashboard">
                            <i class="fas fa-solid fa-house-user"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('product') ? 'active' : '' }}">
                        <a class="nav-link" href="product">
                            <i class="fas fa-solid fa-boxes-stacked"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('meja') ? 'active' : '' }}">
                        <a class="nav-link" href="meja">
                            <i class="fas fa-solid fa-chair"></i>
                            <span>Meja</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('users', 'edit-user') ? 'active' : '' }}">
                        <a class="nav-link" href="users">
                            <i class="fas fa-solid fa-user"></i>
                            <span>User</span>
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'kasir')
                    <li class="nav-item {{ request()->is('transaksi') ? 'active' : '' }}">
                        <a class="nav-link" href="transaksi">
                            <i class="fas fa-solid fa-cash-register"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('history-transaksi') ? 'active' : '' }}">
                        <a class="nav-link" href="history-transaksi">
                            <i class="fas fa-solid fa-clock-rotate-left"></i>
                            <span>History Transaksi</span>
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'owner')
                    <li class="nav-item {{ request()->is('log') ? 'active' : '' }}">
                        <a class="nav-link" href="log">
                            <i class="fas fa-solid fa-clipboard-list"></i>
                            <span>Log</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('history-transaksi') ? 'active' : '' }}">
                        <a class="nav-link" href="history-transaksi">
                            <i class="fas fa-solid fa-clock-rotate-left"></i>
                            <span>History Transaksi</span>
                        </a>
                    </li>
                @endif
            @endif
            

            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="logout">
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
                        <span>Copyright &copy; Big Food 2024</span>
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
    <!-- <script src="{{ asset('js/jquery.dataTables.js') }}"></script> -->
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    


</body>

</html>