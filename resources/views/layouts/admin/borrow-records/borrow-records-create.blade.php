@extends('layouts.admin.home')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Borrow Book</h1>
        <p class="text-muted mb-0">
            Create a new borrowing record.
        </p>
    </div>

    <a href="{{ route('admin.borrow-records') }}"
       class="btn btn-light border">
        Back
    </a>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.borrow-records.store') }}"
              method="POST">

            @csrf

            @include('layouts.admin.borrow-records.form')

            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-primary">
                    Borrow Book
                </button>
            </div>

        </form>

    </div>
</div>

@endsection