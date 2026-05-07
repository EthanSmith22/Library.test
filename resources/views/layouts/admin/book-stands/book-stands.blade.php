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
        <h1 class="h3 mb-1 fw-bold">Book Stands</h1>
        <p class="text-muted mb-0">Manage shelves, floors, and book locations.</p>
    </div>

    <a href="{{ route('admin.book-stands.create') }}" class="btn btn-primary btn-sm">
        Add Book Stand
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Floor</th>
                    <th>Section</th>
                    <th>Copies</th>
                    <th>Description</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($stands as $stand)
                    <tr>
                        <td class="fw-semibold">{{ $stand->code }}</td>
                        <td>{{ $stand->floor }}</td>
                        <td>{{ $stand->section }}</td>
                        <td>{{ $stand->copies_count }}</td>
                        <td>{{ $stand->description ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.book-stands.edit', $stand) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.book-stands.destroy', $stand) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this stand?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No book stands found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection