@extends('layouts.admin.home')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Edit Author</h1>
        <p class="text-muted mb-0">Update author information.</p>
    </div>

    <a href="{{ route('admin.authors') }}" class="btn btn-light border">Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.authors.update', $author) }}" method="POST">
            @csrf
            @method('PUT')

            @include('layouts.admin.authors.form')

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary">Update Author</button>
            </div>
        </form>
    </div>
</div>
@endsection