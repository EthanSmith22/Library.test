@extends('layouts.user.home')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-lg-5 col-md-7">
        <div class="card border-0 shadow-lg auth-card">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 64px; height: 64px;">
                        <i data-feather="lock"></i>
                    </div>

                    <h2 class="fw-bold mb-1">Welcome Back</h2>
                    <p class="text-muted mb-0">Login to continue using LibraryDB</p>
                </div>

                <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input name="email" type="email" class="form-control form-control-lg" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input name="password" type="password" class="form-control form-control-lg">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <a href="#" class="small text-primary text-decoration-none">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
                </form>

                <p class="text-center text-muted mt-4 mb-0">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">
                        Sign Up
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-card {
        animation: authFadeUp .55s ease both;
        border-radius: 18px;
    }

    .auth-card .form-control {
        border-radius: 12px;
    }

    .auth-card .btn {
        border-radius: 12px;
    }

    @keyframes authFadeUp {
        from {
            opacity: 0;
            transform: translateY(24px) scale(.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
</style>

@endsection