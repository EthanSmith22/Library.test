@extends('layouts.admin.home')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="h3 fw-bold mb-1">Add Genre</h1>
        <p class="text-muted mb-0">
            Create a new book genre.
        </p>
    </div>

    <a href="{{ route('admin.genres') }}"
       class="btn btn-light border">
        Back
    </a>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <form action="{{ route('admin.genres.store') }}"
              method="POST">

            @csrf

            @include('layouts.admin.genres.form')

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary">
                    Save Genre
                </button>
            </div>

        </form>

    </div>

</div>

@endsection