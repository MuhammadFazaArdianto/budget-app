<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboardl</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('dashboarduser/assets/images/logos/favicon.png') }}">
  {{-- <link rel="stylesheet" href="{{ asset('dashboarduser/assets/css/styles.min.css') }}"> --}}
  <link rel="stylesheet" href="{{asset('dashboarduser/assets/css/styles.min.css')}}">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <link rel="stylesheet" href="../../../../public/dashboarduser/assets/css/styles.min.css"> --}}
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    
    <!--  Sidebar Start -->
    @include('admin.component.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
       {{-- navbar start --}}
        @include('admin.component.navbar')
       {{-- navbar end --}}
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          @include('sweetalert::alert')
          @yield('content')
          {{-- <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="#"
                class="pe-1 text-primary text-decoration-underline">Wrappixel.com</a> Distributed by <a href="https://themewagon.com" target="_blank" >ThemeWagon</a></p>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{asset('dashboarduser/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('dashboarduser/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('dashboarduser/assets/js/app.min.js')}}"></script>
  <script src="{{asset('dashboarduser/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('dashboarduser/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('dashboarduser/assets/js/dashboard.js')}}"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>