@extends('layouts.admin.home')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Book Management</h1>
        <p class="text-muted mb-0">Manage books, authors, genres, copies, and availability.</p>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm px-3">
        <i data-feather="arrow-left" class="me-1"></i>
        Dashboard
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2">
        <i data-feather="check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2">
        <i data-feather="alert-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small fw-semibold mb-1">Total Books</p>
                    <h2 class="fw-bold mb-0">{{ $books->count() }}</h2>
                    <small class="text-muted">Filtered result</small>
                </div>

                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="book-open"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small fw-semibold mb-1">Available Copies</p>
                    <h2 class="fw-bold mb-0">
                        {{ $books->sum(fn ($book) => $book->copies->where('status', 'available')->count()) }}
                    </h2>
                    <small class="text-muted">Ready to borrow</small>
                </div>

                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small fw-semibold mb-1">Borrowed Copies</p>
                    <h2 class="fw-bold mb-0">
                        {{ $books->sum(fn ($book) => $book->copies->where('status', 'borrowed')->count()) }}
                    </h2>
                    <small class="text-muted">Currently borrowed</small>
                </div>

                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="bookmark"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted small fw-semibold mb-1">Genres</p>
                    <h2 class="fw-bold mb-0">{{ $genres->count() }}</h2>
                    <small class="text-muted">Book categories</small>
                </div>

                <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="layers"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="GET" action="{{ route('admin.books') }}" class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3 p-md-4">
        <div class="row g-3 align-items-center">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i data-feather="search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0 bg-light"
                        placeholder="Search by book title or author..."
                    >
                </div>
            </div>

            <div class="col-lg-3">
                <select name="genre" class="form-select bg-light">
                    <option value="">All Genres</option>

                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(request('genre') == $genre->id)>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3">
                <select name="status" class="form-select bg-light">
                    <option value="">All Availability</option>
                    <option value="available" @selected(request('status') === 'available')>Available</option>
                    <option value="borrowed" @selected(request('status') === 'borrowed')>Borrowed</option>
                    <option value="pending_return" @selected(request('status') === 'pending_return')>Pending Return</option>
                    <option value="unavailable" @selected(request('status') === 'unavailable')>Unavailable</option>
                </select>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('admin.books') }}" class="btn btn-outline-secondary btn-sm px-3">
                    Reset
                </a>

                <button type="submit" class="btn btn-primary btn-sm px-4">
                    Search
                </button>
            </div>
        </div>
    </div>
</form>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <h5 class="fw-bold mb-1">Books List</h5>
                <small class="text-muted">All books registered in the library database.</small>
            </div>

            <span class="badge bg-light text-dark border px-3 py-2">
                {{ $books->count() }} Results
            </span>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Book</th>
                        <th>Author</th>
                        <th>Genres</th>
                        <th>Copies</th>
                        <th>Availability</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($books as $book)
                        @php
                            $available = $book->copies->where('status', 'available')->count();
                            $borrowed = $book->copies->where('status', 'borrowed')->count();
                            $pending = $book->copies->where('status', 'pending_return')->count();
                            $totalCopies = $book->copies->count();
                        @endphp

                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-4 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                         style="width: 48px; height: 48px;">
                                        <i data-feather="book"></i>
                                    </div>

                                    <div>
                                        <p class="fw-semibold mb-0">{{ $book->title }}</p>
                                        <small class="text-muted">
                                            {{ Str::limit($book->description ?? 'No description available.', 55) }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $book->author?->name ?? 'Unknown Author' }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @forelse ($book->genres as $genre)
                                        <span class="badge bg-light text-dark border">
                                            {{ $genre->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted small">No genre</span>
                                    @endforelse
                                </div>
                            </td>

                            <td>
                                <div class="small">
                                    <div class="d-flex gap-2">
                                        <span class="text-muted">Total:</span>
                                        <strong>{{ $totalCopies }}</strong>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="text-muted">Borrowed:</span>
                                        <strong>{{ $borrowed }}</strong>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if ($available > 0)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        {{ $available }} Available
                                    </span>
                                @elseif ($pending > 0)
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                        Pending Return
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                        Unavailable
                                    </span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('user.books.show', $book) }}"
                                       class="btn btn-outline-secondary btn-sm"
                                       target="_blank">
                                        View
                                    </a>

                                    <button class="btn btn-outline-primary btn-sm" disabled>
                                        Edit
                                    </button>

                                    <button class="btn btn-outline-danger btn-sm" disabled>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                     style="width: 64px; height: 64px;">
                                    <i data-feather="inbox" class="text-muted"></i>
                                </div>

                                <h5 class="fw-bold mb-1">No books found</h5>
                                <p class="text-muted mb-0">Try changing your search or filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection