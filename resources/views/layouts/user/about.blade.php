@extends('layouts.user.home')

@section('content')

<div class="container-fluid p-0">

    <section class="row align-items-center g-4 mb-4">
        <div class="col-lg-7">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">
                About LibraryDB
            </span>

            <h1 class="display-6 fw-bold mb-3">
                A modern library management system for organized book operations.
            </h1>

            <p class="text-muted mb-4" style="max-width: 680px;">
                LibraryDB helps libraries manage books, authors, genres, physical copies,
                shelf locations, members, and borrowing records through one structured platform.
            </p>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('user.books') }}" class="btn btn-primary px-4">
                    Browse Books
                </a>
                <a href="{{ route('user.authors') }}" class="btn btn-outline-secondary px-4">
                    View Authors
                </a>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">System Summary</h5>
                            <small class="text-muted">Core platform information</small>
                        </div>

                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                             style="width: 46px; height: 46px;">
                            <i data-feather="database"></i>
                        </div>
                    </div>

                    @php
                        $summaries = [
                            ['label' => 'Platform Type', 'value' => 'Library DBMS'],
                            ['label' => 'Core Users', 'value' => 'Members, Authors, Admin'],
                            ['label' => 'Main Focus', 'value' => 'Book Operations'],
                            ['label' => 'Data Structure', 'value' => 'Relational Database'],
                        ];
                    @endphp

                    @foreach ($summaries as $summary)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2 gap-3">
                            <span class="text-muted small">{{ $summary['label'] }}</span>
                            <strong class="small text-end">{{ $summary['value'] }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4">
        @php
            $cards = [
                [
                    'icon' => 'target',
                    'color' => 'primary',
                    'title' => 'Vision',
                    'text' => 'To provide a clean and dependable digital library platform where book information and borrowing records can be managed clearly.'
                ],
                [
                    'icon' => 'flag',
                    'color' => 'info',
                    'title' => 'Mission',
                    'text' => 'To reduce manual library work, improve record accuracy, and support faster access to book and member information.'
                ],
                [
                    'icon' => 'layers',
                    'color' => 'warning',
                    'title' => 'Scope',
                    'text' => 'The system covers book cataloguing, author records, genre classification, copy tracking, and borrow management.'
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-{{ $card['color'] }} bg-opacity-10 text-{{ $card['color'] }} d-flex align-items-center justify-content-center mb-3"
                             style="width: 48px; height: 48px;">
                            <i data-feather="{{ $card['icon'] }}"></i>
                        </div>

                        <h4 class="fw-bold mb-2">{{ $card['title'] }}</h4>
                        <p class="text-muted mb-0">{{ $card['text'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <section class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-lg-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">
                        Capabilities
                    </span>

                    <h3 class="fw-bold mb-3">Core System Capabilities</h3>

                    <p class="text-muted mb-0">
                        LibraryDB is structured around real library workflows, making it easier to control
                        data relationships between books, copies, members, and borrowing activities.
                    </p>
                </div>

                <div class="col-lg-7">
                    <div class="row g-3">
                        @php
                            $capabilities = [
                                ['icon' => 'book-open', 'title' => 'Book Catalogue', 'text' => 'Manage title, author, release date, and description.'],
                                ['icon' => 'check-square', 'title' => 'Copy Availability', 'text' => 'Track available, borrowed, reserved, lost, or damaged copies.'],
                                ['icon' => 'users', 'title' => 'Member Records', 'text' => 'Store member contact, address, and joined date.'],
                                ['icon' => 'repeat', 'title' => 'Borrowing History', 'text' => 'Monitor borrow dates, due dates, and return dates.'],
                            ];
                        @endphp

                        @foreach ($capabilities as $capability)
                            <div class="col-md-6">
                                <div class="border rounded-4 p-3 h-100 bg-light bg-opacity-50">
                                    <div class="d-flex gap-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                             style="width: 38px; height: 38px;">
                                            <i data-feather="{{ $capability['icon'] }}"></i>
                                        </div>

                                        <div>
                                            <h6 class="fw-bold mb-1">{{ $capability['title'] }}</h6>
                                            <p class="text-muted small mb-0">{{ $capability['text'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">Operational Scope</h4>

                    @php
                        $scopes = [
                            'Maintain books, authors, and genres in a centralized catalogue.',
                            'Manage physical book copies and their assigned book stands.',
                            'Register members and track their borrowing records.',
                            'Support admin and author areas for future role-based access.',
                        ];
                    @endphp

                    <ul class="list-unstyled mb-0">
                        @foreach ($scopes as $scope)
                            <li class="d-flex align-items-start gap-2 mb-3">
                                <i data-feather="check-circle" class="text-primary flex-shrink-0"></i>
                                <span class="text-muted">{{ $scope }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">Database Structure</h4>

                    @php
                        $tables = [
                            'books', 'authors', 'genres', 'book_genre',
                            'book_stands', 'members', 'book_copies', 'borrow_records'
                        ];
                    @endphp

                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($tables as $table)
                            <span class="badge bg-light text-dark border px-3 py-2">
                                {{ $table }}
                            </span>
                        @endforeach
                    </div>

                    <p class="text-muted small mt-3 mb-0">
                        The database follows relational design so books can connect with authors,
                        genres, copies, stands, and borrowing records clearly.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-lg-5 text-center">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">
                LibraryDB
            </span>

            <h3 class="fw-bold mb-2">Designed for clear library operations</h3>

            <p class="text-muted mb-4 mx-auto" style="max-width: 650px;">
                From cataloguing books to checking borrow records, LibraryDB provides a structured
                foundation for a complete library management workflow.
            </p>

            <a href="{{ route('user.books') }}" class="btn btn-primary px-4">
                Explore Library Books
            </a>
        </div>
    </section>

</div>

@endsection