@extends('layouts.user.home')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <section class="row align-items-center g-4 mb-4">
            <div class="col-lg-7">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3">
                    Library Database System
                </span>

                <h1 class="display-6 fw-bold mb-3">
                    Manage and explore library books with a clean digital system.
                </h1>

                <p class="text-muted mb-4" style="max-width: 620px;">
                    Browse books, authors, genres, copies, and borrowing records in one simple library management platform.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <a href="#books" class="btn btn-primary px-4">
                        <i class="align-middle me-1" data-feather="book-open"></i>
                        Browse Books
                    </a>

                    <a href="#about" class="btn btn-outline-secondary px-4">
                        Learn More
                    </a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">System Overview</h5>
                                <small class="text-muted">Library activity summary</small>
                            </div>

                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                                 style="width: 46px; height: 46px;">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                        </div>

                        <div class="row g-3 text-center">
                            <div class="col-6">
                                <div class="border rounded-4 p-3 bg-light bg-opacity-50">
                                    <h3 class="fw-bold mb-0 text-primary">120+</h3>
                                    <small class="text-muted">Books</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded-4 p-3 bg-light bg-opacity-50">
                                    <h3 class="fw-bold mb-0 text-info">45+</h3>
                                    <small class="text-muted">Members</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded-4 p-3 bg-light bg-opacity-50">
                                    <h3 class="fw-bold mb-0 text-warning">12</h3>
                                    <small class="text-muted">Genres</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="border rounded-4 p-3 bg-light bg-opacity-50">
                                    <h3 class="fw-bold mb-0 text-danger">8</h3>
                                    <small class="text-muted">Borrowed</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="row g-3 mb-4">
            @php
                $features = [
                    ['icon' => 'book', 'color' => 'primary', 'title' => 'Books', 'text' => 'Store titles, descriptions, release dates, copies, and author details.'],
                    ['icon' => 'user', 'color' => 'info', 'title' => 'Authors', 'text' => 'Manage author profiles and connect writers with their books.'],
                    ['icon' => 'layers', 'color' => 'warning', 'title' => 'Genres', 'text' => 'Organize books into categories for easier discovery.'],
                    ['icon' => 'repeat', 'color' => 'danger', 'title' => 'Borrowing', 'text' => 'Track borrow dates, due dates, returns, and copy status.'],
                ];
            @endphp

            @foreach ($features as $feature)
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body p-4">
                            <div class="rounded-circle bg-{{ $feature['color'] }} bg-opacity-10 text-{{ $feature['color'] }} d-flex align-items-center justify-content-center mb-3"
                                 style="width: 46px; height: 46px;">
                                <i data-feather="{{ $feature['icon'] }}"></i>
                            </div>

                            <h5 class="fw-bold mb-2">{{ $feature['title'] }}</h5>
                            <p class="text-muted small mb-0">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        <section id="books" class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">Featured Books</h5>
                        <small class="text-muted">Popular books available in the library</small>
                    </div>

                    <div class="input-group input-group-sm" style="max-width: 280px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i data-feather="search"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 bg-light" placeholder="Search books...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    @forelse ($books as $book)
                        @php
                            $availableCopies = $book->copies->where('status', 'available')->count();
                            $firstGenre = $book->genres->first();
                        @endphp

                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            {{ $firstGenre?->name ?? 'General' }}
                                        </span>

                                        @if ($availableCopies > 0)
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                Available
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                                Unavailable
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <div class="rounded-4 overflow-hidden bg-light d-flex align-items-center justify-content-center"
                                             style="height: 160px;">
                                            
                                            @if ($book->image)
                                                <img src="{{ asset('storage/' . $book->image) }}"
                                                     class="w-100 h-100 object-fit-cover"
                                                     alt="book">
                                            @else
                                                <i data-feather="book" class="text-muted" style="width: 40px; height: 40px;"></i>
                                            @endif
                                    
                                        </div>
                                    </div>
                                    
                                    <h5 class="fw-bold mb-2">{{ $book->title }}</h5>

                                    <p class="text-muted small mb-3">
                                        {{ Str::limit($book->description ?? 'No description available.', 95) }}
                                    </p>

                                    <div class="d-flex align-items-center justify-content-between border-top pt-3">
                                        <small class="text-muted">
                                            {{ $book->author?->name ?? 'Unknown Author' }}
                                        </small>

                                        <small class="fw-semibold text-dark">
                                            {{ $availableCopies }} copies
                                        </small>
                                    </div>

                                    <a href="{{ route('user.books.show', $book) }}" class="btn btn-outline-primary btn-sm w-100 mt-3">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <h5 class="fw-bold mb-1">No books found</h5>
                                <p class="text-muted mb-0">Books will appear here once they are added.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="authors" class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">Popular Authors</h5>
                        <small class="text-muted">Explore writers registered in the library system</small>
                    </div>

                    <a href="{{ route('user.authors') }}" class="btn btn-outline-primary btn-sm">
                        View All Authors
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    @forelse ($authors as $author)
                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3 fw-bold"
                                             style="width: 56px; height: 56px;">
                                            {{ strtoupper(substr($author->name, 0, 2)) }}
                                        </div>

                                        <div>
                                            <h5 class="fw-bold mb-1">{{ $author->name }}</h5>
                                            <small class="text-muted">
                                                {{ $author->books_count }} published books
                                            </small>
                                        </div>
                                    </div>

                                    <p class="text-muted small mb-3">
                                        {{ Str::limit($author->description ?? 'This author is part of the library collection.', 100) }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-light text-dark border">
                                            DOB: {{ $author->dob ?? 'N/A' }}
                                        </span>

                                        <a href="{{ route('user.authors.show', $author) }}" class="btn btn-outline-primary btn-sm">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted mb-0">No authors found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="genres" class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">Book Genres</h5>
                        <small class="text-muted">Browse collections by category and reading interest</small>
                    </div>

                    <a href="{{ route('user.genres') }}" class="btn btn-outline-primary btn-sm">
                        View All Genres
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    @forelse ($genres as $genre)
                        <div class="col-md-6 col-xl-3">
                            <div class="card border-0 shadow-sm h-100 rounded-4">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold"
                                             style="width: 46px; height: 46px;">
                                            {{ strtoupper(substr($genre->name, 0, 1)) }}
                                        </div>

                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            {{ $genre->books_count }} books
                                        </span>
                                    </div>

                                    <h5 class="fw-bold mb-2">{{ $genre->name }}</h5>

                                    <p class="text-muted small mb-3">
                                        {{ Str::limit($genre->description ?? 'Explore books under this genre.', 85) }}
                                    </p>

                                    <a href="{{ route('user.genres') }}" class="btn btn-outline-primary btn-sm w-100">
                                        Explore Genre
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted mb-0">No genres found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

    </div>
</main>

@endsection