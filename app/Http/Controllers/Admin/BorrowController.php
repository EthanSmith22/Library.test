<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowRecord;

class BorrowController extends Controller
{
    public function pendingReturns()
    {
        $pendingReturns = BorrowRecord::with(['member', 'copy.book', 'copy.stand'])
        ->whereHas('copy', function ($query) {
            $query->where('status', 'pending_return');
        })
        ->latest('borrow_date')
        ->get();

        return view('layouts.admin.pending-returns', compact('pendingReturns'));
    }

    public function confirmReturn(BorrowRecord $borrowRecord)
    {
        if ($borrowRecord->return_date) {
            return back()->with('error', 'This book has already been returned.');
        }

        if ($borrowRecord->copy?->status !== 'pending_return') {
            return back()->with('error', 'No pending return request found.');
        }

        $borrowRecord->update([
            'return_date' => now()->toDateString(),
        ]);

        $borrowRecord->copy->update([
            'status' => 'available',
        ]);

        return back()->with('success', 'Return confirmed successfully.');
    }
}