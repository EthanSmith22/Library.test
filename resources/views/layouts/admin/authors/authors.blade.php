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
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Authors</h1>
        <p class="text-muted mb-0">Manage book authors.</p>
    </div>

    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
        <i data-feather="plus"></i>
        Add Author
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search authors...">
        <button class="btn btn-dark">Search</button>
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Author</th>
                    <th>Date of Birth</th>
                    <th>Description</th>
                    <th>Books</th>
                    <th class="text-end pe-4">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($authors as $author)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $author->name }}</td>
                        <td>{{ $author->dob ?? '-' }}</td>
                        <td>{{ $author->description ?? '-' }}</td>
                        <td>
                            <span class="badge bg-dark">{{ $author->books_count }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                            <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this author?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">No authors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection