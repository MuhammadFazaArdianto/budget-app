@extends('layout.auth')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-lg-10 bg-white rounded shadow-sm overflow-hidden">
        <div class="row flex-column flex-lg-row">
            
            <div class="col-lg-6 p-0">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Register Image" class="img-fluid h-100 w-100 object-fit-cover">
            </div>

            <div class="col-lg-6 p-5">
                <h3 class="mb-4 text-center">Login</h3>
                <form method="POST" action="{{route('login.function')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@example.com" required autofocus>
                    </div>
                    <div class="mb-3 position-relative">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="******" class="form-control" required>
                            <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-3 text-center">
                    Belum punya akun? <a href="{{ route('register') }}">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        }
    }
</script>
@endsection
