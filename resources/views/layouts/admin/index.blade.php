@extends('layouts.admin.home')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 mb-1 fw-bold">Admin Dashboard</h1>
        <p class="text-muted mb-0">Monitor library activity, borrowing status, and return requests.</p>
    </div>

    <a href="http://library.test" class="btn btn-primary btn-sm px-3">
        <i class="align-middle me-1" data-feather="external-link"></i>
        View User Site
    </a>
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

<div class="row g-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 small fw-semibold">Total Books</p>
                    <h2 class="fw-bold mb-0">{{ $totalBooks }}</h2>
                    <small class="text-muted">Books registered</small>
                </div>

                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="book-open"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 small fw-semibold">Members</p>
                    <h2 class="fw-bold mb-0">{{ $totalMembers }}</h2>
                    <small class="text-muted">Registered members</small>
                </div>

                <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 small fw-semibold">Borrowed</p>
                    <h2 class="fw-bold mb-0">{{ $borrowedBooks }}</h2>
                    <small class="text-muted">Currently borrowed</small>
                </div>

                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="bookmark"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 small fw-semibold">Pending Returns</p>
                    <h2 class="fw-bold mb-0">{{ $pendingReturns }}</h2>
                    <small class="text-muted">Waiting confirmation</small>
                </div>

                <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="clock"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <h5 class="fw-bold mb-1">Recent Borrow Records</h5>
                <small class="text-muted">Latest borrowing activities from library members.</small>
            </div>

            <span class="badge bg-light text-dark border px-3 py-2">
                Recent Activity
            </span>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Member</th>
                        <th>Book</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th class="text-end pe-4">Status / Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recentBorrowRecords as $record)
                        @php
                            $borrowDate = \Carbon\Carbon::parse($record->borrow_date);
                            $dueDate = \Carbon\Carbon::parse($record->due_date);
                            $isLate = !$record->return_date && now()->gt($dueDate);
                            $isPending = $record->copy?->status === 'pending_return';
                        @endphp

                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold"
                                         style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($record->member?->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="fw-semibold mb-0">
                                            {{ $record->member?->name ?? 'Unknown' }}
                                        </p>
                                        <small class="text-muted">Library member</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <p class="fw-semibold mb-0">
                                    {{ $record->copy?->book?->title ?? 'Unknown Book' }}
                                </p>
                                <small class="text-muted">
                                    Copy {{ $record->copy?->accession_no ?? 'N/A' }}
                                </small>
                            </td>

                            <td>
                                <span class="text-muted">
                                    {{ $borrowDate->format('d M Y') }}
                                </span>
                            </td>

                            <td>
                                <span class="{{ $isLate ? 'text-danger fw-semibold' : 'text-muted' }}">
                                    {{ $dueDate->format('d M Y') }}
                                </span>
                            </td>

                            <td class="text-end pe-4">
                                @if ($record->return_date)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        Returned
                                    </span>

                                @elseif ($isPending)
                                    <form method="POST"
                                          action="{{ route('admin.borrowings.confirm-return', $record) }}"
                                          onsubmit="return confirm('Confirm this book return?')">
                                        @csrf

                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="align-middle me-1" data-feather="check"></i>
                                            Confirm
                                        </button>
                                    </form>

                                @elseif ($isLate)
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                        Overdue
                                    </span>

                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                        Borrowed
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                     style="width: 64px; height: 64px;">
                                    <i class="text-muted" data-feather="inbox"></i>
                                </div>

                                <h5 class="fw-bold mb-1">No borrow records found</h5>
                                <p class="text-muted mb-0">Recent borrowing activity will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection