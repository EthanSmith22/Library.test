@extends('layouts.admin.home')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Add Book Copy</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.copies.store') }}" method="POST">
                @csrf

                @include('layouts.admin.copies.form')

                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.copies') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection