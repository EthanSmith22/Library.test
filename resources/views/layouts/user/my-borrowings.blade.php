@extends('layouts.user.home')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">My Borrowings</h1>
        <p class="text-muted mb-0">Track your borrowed books, due dates, and return requests.</p>
    </div>

    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
        {{ $borrowRecords->count() }} Borrowed Books
    </span>
</div>

@if (session('success'))
    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2">
        <i data-feather="check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2">
        <i data-feather="alert-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <h5 class="fw-bold mb-1">Borrowed Books</h5>
        <small class="text-muted">Manage the books currently linked to your account.</small>
    </div>

    <div class="card-body">
        <div class="row g-4">
            @forelse ($borrowRecords as $record)
                @php
                    $dueDate = \Carbon\Carbon::parse($record->due_date);
                    $borrowDate = \Carbon\Carbon::parse($record->borrow_date);
                    $isLate = !$record->return_date && now()->gt($dueDate);
                    $isPending = $record->copy?->status === 'pending_return';
                @endphp

                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                                     style="width: 46px; height: 46px;">
                                    <i data-feather="book-open"></i>
                                </div>

                                @if ($record->return_date)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        Returned
                                    </span>
                                @elseif ($isPending)
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                        Pending Return
                                    </span>
                                @elseif ($isLate)
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                        Overdue
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                        Borrowed
                                    </span>
                                @endif
                            </div>

                            <h5 class="fw-bold mb-2 text-dark">
                                {{ $record->copy->book->title ?? 'Unknown Book' }}
                            </h5>

                            <p class="text-muted small mb-4">
                                by {{ $record->copy->book->author->name ?? 'Unknown Author' }}
                            </p>

                            <div class="border rounded-4 p-3 bg-light bg-opacity-50 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Borrow Date</span>
                                    <strong class="small text-dark">
                                        {{ $borrowDate->format('d M Y') }}
                                    </strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Due Date</span>
                                    <strong class="small {{ $isLate ? 'text-danger' : 'text-dark' }}">
                                        {{ $dueDate->format('d M Y') }}
                                    </strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Copy No.</span>
                                    <strong class="small text-dark">
                                        {{ $record->copy->accession_no ?? 'N/A' }}
                                    </strong>
                                </div>
                            </div>

                            @if ($isLate && !$record->return_date && !$isPending)
                                <div class="alert alert-danger border-0 small py-2 mb-3">
                                    This book is past its due date.
                                </div>
                            @elseif ($isPending)
                                <div class="alert alert-info border-0 small py-2 mb-3">
                                    Waiting for admin confirmation.
                                </div>
                            @endif

                            @if ($record->return_date)
                                <button class="btn btn-success btn-sm w-100" disabled>
                                    <i class="align-middle me-1" data-feather="check"></i>
                                    Returned
                                </button>

                            @elseif ($isPending)
                                <form method="POST" action="{{ route('user.borrowings.cancel-return', $record) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        Cancel Return Request
                                    </button>
                                </form>

                            @else
                                <form method="POST" action="{{ route('user.borrowings.request-return', $record) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        Request Return
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px;">
                            <i class="text-muted" data-feather="book"></i>
                        </div>

                        <h5 class="fw-bold mb-1">No borrowings yet</h5>
                        <p class="text-muted mb-0">Borrowed books will appear here.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection