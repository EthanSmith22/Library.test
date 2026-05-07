<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | LibraryDB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">

    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ url('/') }}">
                <span class="align-middle">LibraryDB Admin</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">Management</li>
            
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i>
                        <span class="align-middle">Dashboard</span>
                    </a>
                </li>
            
                <li class="sidebar-item {{ request()->routeIs('admin.books') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.books') }}">
                        <i class="align-middle" data-feather="book"></i>
                        <span class="align-middle">Books</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.copies*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.copies') }}">
                        <i class="align-middle" data-feather="book-open"></i>
                        <span class="align-middle">Book Copies</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.book-stands*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.book-stands') }}">
                        <i class="align-middle" data-feather="archive"></i>
                        <span class="align-middle">Book Stands</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.authors*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.authors') }}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">Authors</span>
                    </a>
                </li>
            
                <li class="sidebar-item {{ request()->routeIs('admin.genres*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.genres') }}">
                        <i class="align-middle" data-feather="layers"></i>
                        <span class="align-middle">Genres</span>
                    </a>
                </li>
            
                <li class="sidebar-item {{ request()->routeIs('admin.members*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.members') }}">
                        <i class="align-middle" data-feather="user"></i>
                        <span class="align-middle">Members</span>
                    </a>
                </li>
            
                <li class="sidebar-header">Library Flow</li>
            
                <li class="sidebar-item {{ request()->routeIs('admin.borrow-records*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.borrow-records') }}">
                        <i class="align-middle" data-feather="repeat"></i>
                        <span class="align-middle">Borrow Records</span>
                    </a>
                </li>
            
                <li class="sidebar-item {{ request()->routeIs('admin.pending-returns') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.pending-returns') }}">
                        <i class="align-middle" data-feather="check-circle"></i>
                        <span class="align-middle">Pending Returns</span>
                    </a>
                </li>
            
                <li class="sidebar-item">
                    <a class="sidebar-link" href="http://library.test" target="_blank">
                        <i class="align-middle" data-feather="external-link"></i>
                        <span class="align-middle">View User Site</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                
                        <button type="submit"
                                class="sidebar-link border-0 bg-transparent w-100 text-start">
                            <i class="align-middle" data-feather="log-out"></i>
                            <span class="align-middle">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main">

    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link text-dark fw-semibold">
                        Admin
                    </span>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container-fluid">
            <div class="text-muted text-center">
                LibraryDB Admin © {{ date('Y') }}
            </div>
        </div>
    </footer>

</div>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    if (window.feather) {
        feather.replace();
    }
</script>
</body>
</html>