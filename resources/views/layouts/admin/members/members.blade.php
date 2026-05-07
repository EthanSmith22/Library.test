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
        <h1 class="h3 fw-bold mb-1">Members</h1>
        <p class="text-muted mb-0">Manage library members.</p>
    </div>

    <a href="{{ route('admin.members.create') }}" class="btn btn-primary">
        <i data-feather="plus"></i>
        Add Member
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name, email, or phone">
        <button class="btn btn-dark">Search</button>
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Joined Date</th>
                    <th>Borrow Records</th>
                    <th class="text-end pe-4">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td>{{ $member->joined_date ?? '-' }}</td>
                        <td>
                            <span class="badge bg-dark">{{ $member->borrow_records_count }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this member?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">No members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection