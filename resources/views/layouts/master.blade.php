<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Neraca-app | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    {{-- <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" />

    <!-- Ionicons -->
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />

    <!-- Tempusdominus Bootstrap 4 -->
    <link
      rel="stylesheet"
      href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"
    />

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <!-- iCheck -->
    <link
      rel="stylesheet"
      href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"
    />

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}" />

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"/>

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" />

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}" />

    <!-- DataTables -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('jquery/jquery.dataTables.css') }}"> --}}

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}" type="text/css">

  </head>
<body style="font-family: 'Quicksand', sans-serif;" class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-cogs"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <i class="fas fa-user"></i> Profile
              </a>
              <a href="#" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-danger elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('index') }}" class="brand-link">
          <img
            src="{{ asset('dist/img/AdminLTELogo.png') }}"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />
          <span class="brand-text font-weight-light">Nerca-app</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="{{ asset('dist/img/user2-160x160.jpg') }}"
                class="img-circle elevation-2"
                alt="User Image"
              />
            </div>
            <div class="info">
                <a href="#" class="d-block"></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                <a href="{{ route('index') }}" class="nav-link {{ Route::is('index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    Dashboard
                    </p>
                </a>
                </li>
                <li class="nav-header">Keuangan</li>
                <li class="nav-item {{ Route::is('kas_bank') ? 'menu-is-opening menu-open' : '' }} || {{ Route::is('kas_besar') ? 'menu-is-opening menu-open' : '' }} || {{ Route::is('kas_kecil') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('kas_bank') ? 'active' : ''}} || {{ Route::is('kas_besar') ? 'active' : '' }} || {{ Route::is('kas_kecil') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-money-bill-alt"></i>
                      <p>
                        Neraca
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('kas_bank') }}" class="nav-link {{ Route::is('kas_bank') ? 'active' : '' }}">
                          <i class="fas fa-user-graduate nav-icon"></i>
                          <p>Kas Bank</p>
                        </a>
                      </li>
                      <li class="nav-item a">
                        <a href="{{ route('kas_besar') }}" class="nav-link {{ Route::is('kas_besar') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <p>
                            Kas Besar
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('kas_kecil') }}" class="nav-link {{ Route::is('kas_kecil') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <p>
                            Kas Kecil
                            </p>
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('buyIndex') ? 'menu-is-opening menu-open' : '' }} || {{ Route::is('index_assets') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('buyIndex') ? 'active' : '' }} || {{ Route::is('index_assets') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-money-bill-alt"></i>
                      <p>
                        Arus Kas
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('buyIndex') }}" class="nav-link {{ Route::is('buyIndex') ? 'active' : '' }}">
                          <i class="fas fa-user-graduate nav-icon"></i>
                          <p>Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('index_sell') }}" class="nav-link">
                          <i class="fas fa-user-graduate nav-icon"></i>
                          <p>Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('index_assets') }}" class="nav-link {{ Route::is('index_assets') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <p>
                            Aset
                            </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('employee.index') }}" class="nav-link">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <p>
                            Karyawan
                            </p>
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="nav-header">Data Master</li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                        Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('index_bank') }}" class="nav-link {{ Route::is('index_bank') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                        Bank
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('position.index') }}" class="nav-link {{ Route::is('position.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                        Jabatan
                        </p>
                    </a>
                </li>
            </ul>
          </nav>

          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('konten')
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong
          >Copyright &copy; 2021
          <a href="https://adminlte.io">CariCuan</a>.</strong
        >
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.0.0
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('sweetalert::alert')

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- Aos JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- SWAL -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
  @stack('js')
</html>
