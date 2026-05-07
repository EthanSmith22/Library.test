@extends('layouts.admin.home')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1 fw-bold">Edit Book Stand</h1>
        <p class="text-muted mb-0">Update shelf, floor, section, and location details.</p>
    </div>

    <a href="{{ route('admin.book-stands') }}" class="btn btn-outline-secondary btn-sm">
        <i class="align-middle me-1" data-feather="arrow-left"></i>
        Back
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.book-stands.update', $bookStand) }}" method="POST">
            @csrf
            @method('PUT')

            @include('layouts.admin.book-stands.form')

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.book-stands') }}" class="btn btn-light">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="align-middle me-1" data-feather="save"></i>
                    Update Book Stand
                </button>
            </div>
        </form>
    </div>
</div>
@endsection