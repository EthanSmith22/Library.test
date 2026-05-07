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
        <h1 class="h3 fw-bold mb-1">Borrow Records</h1>
        <p class="text-muted mb-0">
            Monitor borrowed books and return activity.
        </p>
    </div>

    <a href="{{ route('admin.borrow-records.create') }}"
       class="btn btn-primary">
        <i data-feather="plus"></i>
        Borrow Book
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">
                <tr>
                    <th class="ps-4">Member</th>
                    <th>Book</th>
                    <th>Copy</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($borrowRecords as $record)

                    @php
                        $isReturned = !!$record->return_date;
                        $isPending = $record->copy?->status === 'pending_return';
                        $isOverdue = !$isReturned && now()->gt($record->due_date);
                    @endphp

                    <tr>

                        <td class="ps-4">
                            {{ $record->member?->name }}
                        </td>

                        <td>
                            {{ $record->copy?->book?->title }}
                        </td>

                        <td>
                            <span class="badge bg-dark">
                                {{ $record->copy?->accession_no }}
                            </span>
                        </td>

                        <td>
                            {{ $record->borrow_date }}
                        </td>

                        <td>
                            {{ $record->due_date }}
                        </td>

                        <td>

                            @if($isReturned)

                                <span class="badge bg-success">
                                    Returned
                                </span>

                            @elseif($isPending)

                                <span class="badge bg-warning text-dark">
                                    Pending Return
                                </span>

                            @elseif($isOverdue)

                                <span class="badge bg-danger">
                                    Overdue
                                </span>

                            @else

                                <span class="badge bg-primary">
                                    Borrowed
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            No borrow records found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>
</div>

@endsection