@extends('layouts.user.home')

@section('content')

@php
    $availableCopies = $book->copies->where('status', 'available')->count();
@endphp

<div class="container py-4">

    <div class="row g-4">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    {{-- BOOK HEADER --}}
                    <div class="d-flex gap-4 align-items-start">

                        <img src="{{ asset('images/' . ($book->cover_image ?? 'default.jpg')) }}"
                             class="rounded"
                             style="width: 150px; height: 220px; object-fit: cover;">

                        <div class="flex-grow-1">
                            <h2 class="fw-bold mb-2">{{ $book->title }}</h2>

                            <p class="text-muted mb-1">
                                by {{ $book->author->name ?? 'Unknown Author' }}
                            </p>

                            <span class="badge bg-primary">
                                {{ $availableCopies }} available
                            </span>

                            <div class="mt-3 small text-muted">
                                <div>ISBN: {{ $book->isbn ?? '-' }}</div>
                                <div>Publisher: {{ $book->publisher ?? '-' }}</div>
                                <div>Language: {{ $book->language ?? '-' }}</div>
                                <div>Pages: {{ $book->pages ?? '-' }}</div>
                                <div>Edition: {{ $book->edition ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <hr class="my-4">

                    <h5 class="fw-bold mb-2">Description</h5>
                    <p class="text-muted">
                        {{ $book->description ?? 'No description available.' }}
                    </p>

                </div>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            {{-- AUTHOR CARD --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Author</h5>

                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 50px; height: 50px;">
                            {{ strtoupper(substr($book->author->name ?? 'A', 0, 1)) }}
                        </div>

                        <div>
                            <div class="fw-semibold">
                                {{ $book->author->name ?? 'Unknown' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 🔥 BORROW ACTION (THIS IS THE FIXED PART) --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Borrow Action</h5>

                    @if ($availableCopies > 0)
                        @if (session('member_id'))
                            <form method="POST" action="{{ route('user.books.borrow', $book) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">
                                    Borrow This Book
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                Login to Borrow
                            </a>
                        @endif
                    @else
                        <button class="btn btn-secondary w-100" disabled>
                            No Copies Available
                        </button>
                    @endif

                </div>
            </div>

            {{-- COPY LOCATIONS --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Copy Locations</h5>

                    @forelse ($book->copies as $copy)
                        <div class="d-flex justify-content-between border-bottom py-2 small">
                            <span>{{ $copy->bookStand->code ?? '-' }}</span>
                            <span class="badge bg-{{ $copy->status === 'available' ? 'success' : 'secondary' }}">
                                {{ ucfirst($copy->status) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted small">No copies found.</p>
                    @endforelse

                </div>
            </div>

        </div>

    </div>

</div>

@endsection