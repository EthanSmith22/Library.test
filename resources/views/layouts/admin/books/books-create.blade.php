@extends('layouts.admin.home')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Add New Book</h1>
        <p class="text-muted mb-0">Create a new book record for the library catalogue.</p>
    </div>

    <a href="{{ route('admin.books') }}" class="btn btn-outline-secondary btn-sm px-3">
        Back to Books
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-1">Book Information</h5>
                    <small class="text-muted">Basic details about the book.</small>
                </div>

                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Book Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Author</label>
                            <select name="author_id" class="form-select" required>
                                <option value="">Select author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" @selected(old('author_id') == $author->id)>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Genres</label>
                            <select name="genres[]" class="form-select" multiple>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" @selected(collect(old('genres'))->contains($genre->id))>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl to select multiple genres.</small>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">ISBN</label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Publisher</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Language</label>
                            <input type="text" name="language" value="{{ old('language') }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pages</label>
                            <input type="number" name="pages" value="{{ old('pages') }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Edition</label>
                            <input type="text" name="edition" value="{{ old('edition') }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Released Date</label>
                            <input type="date" name="released_date" value="{{ old('released_date') }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cover Image</label>
                            <input type="file" name="cover_image" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Save Book</h5>
                    <p class="text-muted small mb-4">
                        After creating the book, you can add physical copies later.
                    </p>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        Create Book
                    </button>

                    <a href="{{ route('admin.books') }}" class="btn btn-outline-secondary w-100">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection