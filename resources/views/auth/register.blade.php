@extends('layout.auth')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-lg-10 bg-white rounded shadow-sm overflow-hidden">
        <div class="row flex-column flex-lg-row">
            
            <div class="col-lg-6 p-0">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Register Image" class="img-fluid h-100 w-100 object-fit-cover">
            </div>

            <div class="col-lg-6 p-5">
                <h3 class="mb-4 text-center">Register</h3>
                <form method="POST" action="{{route('register.function')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="******" class="form-control" required>
                            <span class="input-group-text" onclick="togglePassword('password', 'toggleIcon1')" style="cursor: pointer;">
                                <i class="bi bi-eye" id="toggleIcon1" style="color: #6c757d;"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3 position-relative">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="******" class="form-control" required>
                            <span class="input-group-text" onclick="togglePassword('password_confirmation', 'toggleIcon2')" style="cursor: pointer;">
                                <i class="bi bi-eye" id="toggleIcon2" style="color: #6c757d;"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="mt-3 text-center">
                    Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Mendaftar',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
            icon.style.color = "#0d6efd";
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
            icon.style.color = "#6c757d"; 
        }
    }
</script>
@endsection