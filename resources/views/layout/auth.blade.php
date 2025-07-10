<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth | Budget Buddy</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-black.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body style="background: #F1F1F0">
    @include('sweetalert::alert')
    <div class="container py-5 ">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.all.min.js"></script>
    @yield('scripts')
    
    @if(session('unauthorized'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: '{{ session('unauthorized') }}',
            confirmButtonColor: '#d33'
        });
    </script>
    @endif
</body>
</html>
