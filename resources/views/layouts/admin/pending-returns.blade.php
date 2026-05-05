@extends('layouts.admin.home')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Pending Returns</h1>
        <p class="text-muted mb-0">
            Review and confirm books returned by library members.
        </p>
    </div>

    <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">
        <i class="align-middle me-1" data-feather="arrow-left"></i>
        Back to Dashboard
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

<div class="row mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1">Waiting Confirmation</p>
                    <h2 class="fw-bold mb-0">{{ $pendingReturns->count() }}</h2>
                </div>

                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center"
                     style="width: 48px; height: 48px;">
                    <i data-feather="clock"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <h5 class="fw-bold mb-1">Return Requests</h5>
                <small class="text-muted">Books marked as returned by members but not confirmed yet.</small>
            </div>

            <span class="badge bg-warning text-dark px-3 py-2">
                {{ $pendingReturns->count() }} Pending
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
                        <th>Copy No.</th>
                        <th>Stand</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pendingReturns as $record)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold"
                                         style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($record->member?->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="fw-semibold mb-0">
                                            {{ $record->member?->name ?? 'Unknown Member' }}
                                        </p>
                                        <small class="text-muted">Library member</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <p class="fw-semibold mb-0">
                                    {{ $record->copy?->book?->title ?? 'Unknown Book' }}
                                </p>
                                <small class="text-muted">Book title</small>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $record->copy?->accession_no ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                    {{ $record->copy?->stand?->code ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <span class="text-muted">
                                    {{ $record->borrow_date }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    {{ $record->due_date }}
                                </span>
                            </td>

                            <td class="text-end pe-4">
                                <form method="POST"
                                      action="{{ route('admin.borrowings.confirm-return', $record) }}"
                                      onsubmit="return confirm('Confirm this book return?')">
                                    @csrf

                                    <button class="btn btn-success btn-sm">
                                        <i class="align-middle me-1" data-feather="check"></i>
                                        Confirm Return
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3"
                                         style="width: 64px; height: 64px;">
                                        <i class="text-muted" data-feather="check-circle"></i>
                                    </div>

                                    <h5 class="fw-bold mb-1">No pending returns</h5>
                                    <p class="text-muted mb-0">
                                        All returned books are already confirmed.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection