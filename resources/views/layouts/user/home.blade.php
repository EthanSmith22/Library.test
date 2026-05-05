@php
    $currentMember = session('member_id')
        ? \App\Models\Member::find(session('member_id'))
        : null;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <div class="main w-100">

        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                    LibraryDB
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('user.books') }}">Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('user.authors') }}">Authors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('user.genres') }}">Genres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('user.about') }}">About</a>
                        </li>
                    </ul>

                    @if ($currentMember)
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-dark large ">
                                Hi, <strong style="font-size: 20px;">{{ $currentMember->name }}</strong>
                            </span>

                            <a href="{{ route('user.borrowings') }}" class="btn btn-outline-primary btn-sm px-3">
                                My Borrowings
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-3">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3">
                                Sign Up
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        @yield('content')
        <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© {{ date('Y') }} LibraryDB. All rights reserved.</small>
        </footer>
        <script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    if (window.feather) {
        feather.replace();
    }
</script>
</body>
</html>