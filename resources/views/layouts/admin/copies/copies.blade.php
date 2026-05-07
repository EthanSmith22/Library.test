@extends('layouts.admin.home')

@section('content')
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.dashboard') }}"
       class="btn btn-light border shadow-sm rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 text-dark fw-semibold transition-all">
        
        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
            style="width:28px;height:28px;">
            <i data-feather="arrow-left" style="width:14px;height:14px;"></i>
        </div>

        <span>Dashboard</span>
    </a>
</div>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Book Copies</h1>
        <a href="{{ route('admin.copies.create') }}" class="btn btn-primary">Add Copy</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search accession no or book title">
        </div>

        <div class="col-md-3">
            <select name="book_id" class="form-select">
                <option value="">All Books</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" @selected(request('book_id') == $book->id)>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                @foreach(['available','borrowed','pending_return','reserved','lost','damaged'] as $status)
                    <option value="{{ $status }}" @selected(request('status') == $status)>
                        {{ ucwords(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">Filter</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Accession No</th>
                        <th>Book</th>
                        <th>Author</th>
                        <th>Stand</th>
                        <th>Condition</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($copies as $copy)
                        <tr>
                            <td>{{ $copy->accession_no }}</td>
                            <td>{{ $copy->book?->title }}</td>
                            <td>{{ $copy->book?->author?->name ?? '-' }}</td>
                            <td>{{ $copy->stand?->code ?? '-' }}</td>
                            <td>{{ ucfirst($copy->condition) }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ ucwords(str_replace('_', ' ', $copy->status)) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.copies.edit', $copy) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.copies.destroy', $copy) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this copy?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No copies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection