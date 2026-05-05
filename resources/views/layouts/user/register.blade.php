@extends('layouts.user.home')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-lg-6 col-md-8">
        <div class="card border-0 shadow-lg auth-card">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 64px; height: 64px;">
                        <i data-feather="user-plus"></i>
                    </div>

                    <h2 class="fw-bold mb-1">Create Account</h2>
                    <p class="text-muted mb-0">Join LibraryDB and manage your borrowing activity</p>
                </div>

                <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Your name" name="name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" class="form-control form-control-lg" placeholder="09xxxxxxxx" name="phone">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control form-control-lg" placeholder="name@example.com" name="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <input type="text" class="form-control form-control-lg" placeholder="Your address" name="address">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control form-control-lg" placeholder="Create password" name="password">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control form-control-lg" placeholder="Confirm password" name="password_confirmation">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        Create Account
                    </button>
                </form>

                <p class="text-center text-muted mt-4 mb-0">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                        Login
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