@extends('layouts.user.home')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Genres</h1>
        <p class="text-muted mb-0">Filter books by one or more genres.</p>
    </div>

    <a href="{{ route('user.genres') }}" class="btn btn-outline-secondary btn-sm">
        Clear Filter
    </a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white">
        <h5 class="fw-bold mb-1">Choose Genres</h5>
        <small class="text-muted">Select Fantasy, Classic, Fiction, History, or multiple genres.</small>
    </div>

    <div class="card-body">
        <form method="GET" action="{{ route('user.genres') }}">
            <div class="d-flex flex-wrap gap-2">
                @foreach ($genres as $genre)
                    @php
                        $selected = in_array($genre->id, array_map('intval', $selectedGenres ?? []));
                    @endphp

                    <label class="btn btn-sm {{ $selected ? 'btn-primary' : 'btn-outline-primary' }}">
                        <input
                            type="checkbox"
                            name="genres[]"
                            value="{{ $genre->id }}"
                            class="d-none"
                            {{ $selected ? 'checked' : '' }}
                            onchange="this.form.submit()"
                        >

                        {{ $genre->name }}
                        <span class="badge {{ $selected ? 'bg-light text-primary' : 'bg-primary' }} ms-1">
                            {{ $genre->books_count }}
                        </span>
                    </label>
                @endforeach
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1">Filtered Books</h5>
            <small class="text-muted">
                Showing books that match selected genres.
            </small>
        </div>

        <span class="badge bg-primary">
            {{ $books->count() }} books
        </span>
    </div>

    <div class="card-body">
        <div class="row">
            @forelse ($books as $book)
                @php
                    $availableCopies = $book->copies->where('status', 'available')->count();
                @endphp

                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card border h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                @foreach ($book->genres as $genre)
                                    <span class="badge bg-secondary">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>

                            <h5 class="fw-bold mb-2">{{ $book->title }}</h5>

                            <p class="text-muted small mb-3">
                                {{ Str::limit($book->description ?? 'No description available.', 100) }}
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between small text-muted mb-2">
                                    <span>Author</span>
                                    <strong class="text-dark">{{ $book->author?->name ?? 'Unknown' }}</strong>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <small class="text-muted">Availability</small>

                                    @if ($availableCopies > 0)
                                        <span class="badge bg-success">{{ $availableCopies }} available</span>
                                    @else
                                        <span class="badge bg-warning">Unavailable</span>
                                    @endif
                                </div>

                                <a href="{{ route('user.books.show', $book) }}" class="btn btn-primary btn-sm w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <h5 class="fw-bold">No books found</h5>
                        <p class="text-muted mb-0">Try selecting another genre.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection