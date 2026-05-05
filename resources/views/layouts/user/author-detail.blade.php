@extends('layouts.user.home')

@section('content')

<div class="mb-4">
    <a href="{{ route('user.authors') }}" class="btn btn-outline-secondary btn-sm">
        ← Back to Authors
    </a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">

        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3 fw-bold"
                 style="width: 70px; height: 70px;">
                {{ strtoupper(substr($author->name, 0, 2)) }}
            </div>

            <div>
                <h2 class="fw-bold mb-1">{{ $author->name }}</h2>
                <p class="text-muted mb-0">
                    {{ $author->books->count() }} books published
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="border rounded p-3">
                    <small class="text-muted">Date of Birth</small>
                    <h6 class="fw-bold mb-0 mt-1">{{ $author->dob ?? 'N/A' }}</h6>
                </div>
            </div>

            <div class="col-md-8 mb-3">
                <div class="border rounded p-3 h-100">
                    <small class="text-muted">Biography</small>
                    <p class="mb-0 mt-1">
                        {{ $author->description ?? 'No description available.' }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="fw-bold mb-0">Books by {{ $author->name }}</h5>
    </div>

    <div class="card-body">
        <div class="row">

            @forelse ($author->books as $book)
                <div class="col-md-4 mb-3">
                    <div class="card border h-100">
                        <div class="card-body">

                            <h5 class="fw-bold">{{ $book->title }}</h5>

                            <p class="text-muted small">
                                {{ Str::limit($book->description ?? 'No description.', 90) }}
                            </p>

                            <div class="mb-2">
                                @foreach ($book->genres as $genre)
                                    <span class="badge bg-secondary">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>

                            <a href="{{ route('user.books.show', $book) }}"
                               class="btn btn-outline-primary btn-sm w-100">
                                View Book
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No books found for this author.</p>
            @endforelse

        </div>
    </div>
</div>

@endsection