@extends('layouts.user.home')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Authors</h1>
        <p class="text-muted mb-0">Browse all authors in the library system.</p>
    </div>
</div>

<div class="row">
    @forelse ($authors as $author)
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">

                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                             style="width: 50px; height: 50px;">
                            {{ strtoupper(substr($author->name, 0, 2)) }}
                        </div>

                        <div>
                            <h5 class="fw-bold mb-0">{{ $author->name }}</h5>
                            <small class="text-muted">
                                {{ $author->books_count }} books
                            </small>
                        </div>
                    </div>

                    <p class="text-muted small mb-3">
                        {{ Str::limit($author->description ?? 'No description available.', 120) }}
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            DOB: {{ $author->dob ?? 'N/A' }}
                        </small>

                        <a href="{{ route('user.authors.show', $author) }}" class="btn btn-outline-primary btn-sm">
                            View Books
                        </a>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <h5 class="fw-bold">No authors found</h5>
                    <p class="text-muted mb-0">Authors will appear here once added.</p>
                </div>
            </div>
        </div>
    @endforelse
</div>

@endsection