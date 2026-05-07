@extends('layouts.admin.home')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Add Author</h1>
        <p class="text-muted mb-0">Create a new author profile.</p>
    </div>

    <a href="{{ route('admin.authors') }}" class="btn btn-light border">Back</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.authors.store') }}" method="POST">
            @csrf

            @include('layouts.admin.authors.form')

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary">Save Author</button>
            </div>
        </form>
    </div>
</div>
@endsection