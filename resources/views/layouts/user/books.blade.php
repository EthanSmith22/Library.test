@extends('layouts.user.home')
@section('content')

        <main class="content">
            <div class="container-fluid p-0">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 fw-bold mb-1">Books Collection</h1>
                        <p class="text-muted mb-0">Browse all books available in the library system.</p>
                    </div>

                    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
                        Back Home
                    </a>
                </div>

                <form method="GET" action="{{ route('user.books') }}" class="card border-0 shadow-sm rounded-4 mb-4">
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
                                        placeholder="Search by title or author..."
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
                                    <option value="available" @selected(request('status') === 'available')>
                                        Available
                                    </option>
                                    <option value="unavailable" @selected(request('status') === 'unavailable')>
                                        Unavailable
                                    </option>
                                </select>
                            </div>
                
                            <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('user.books') }}" class="btn btn-outline-secondary btn-sm px-3">
                                    Reset
                                </a>
                
                                <button type="submit" class="btn btn-primary btn-sm px-4">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row g-4">
                    @forelse ($books as $book)
                        <div class="col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">

                                {{-- 📸 Book Cover --}}
                                <div class="position-relative">
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                         style="height: 180px;">

                                        @if ($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}"
                                                 class="w-100 h-100 object-fit-cover"
                                                 alt="book">
                                        @else
                                            <i data-feather="book" class="text-muted" style="width: 48px; height: 48px;"></i>
                                        @endif

                                    </div>

                                    {{-- Genre --}}
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            {{ $book->genres->first()?->name ?? 'General' }}
                                        </span>
                                    </div>

                                    {{-- Availability --}}
                                    <div class="position-absolute top-0 end-0 m-3">
                                        @if ($book->copies->where('status','available')->count() > 0)
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                Available
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                                Unavailable
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="card-body p-4 d-flex flex-column">

                                    <h5 class="fw-bold mb-2">
                                        {{ $book->title }}
                                    </h5>

                                    <p class="text-muted small mb-3">
                                        by {{ $book->author?->name ?? 'Unknown Author' }}
                                    </p>

                                    <p class="text-muted small mb-3">
                                        {{ Str::limit($book->description ?? 'No description available.', 90) }}
                                    </p>

                                    <div class="mt-auto">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <small class="text-muted">Copies</small>
                                            <span class="fw-semibold">
                                                {{ $book->copies->where('status','available')->count() }}
                                            </span>
                                        </div>

                                        <a href="{{ route('user.books.show', $book) }}"
                                           class="btn btn-outline-primary btn-sm w-100">
                                            View Details
                                        </a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <h5 class="fw-bold mb-1">No books found</h5>
                                <p class="text-muted mb-0">Books will appear here once added.</p>
                            </div>
                        </div>
                    @endforelse
                    
                </div>

            </div>
        </main>

    </div>
</div>
</body>
</html>
@endsection