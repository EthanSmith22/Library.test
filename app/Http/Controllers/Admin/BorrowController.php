<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\BorrowRecord;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $borrowRecords = BorrowRecord::with(['member', 'copy.book', 'copy.stand'])
            ->latest('borrow_date')
            ->get();

        return view('layouts.admin.borrow-records.borrow-records', compact('borrowRecords'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();

        $books = Book::withCount([
            'copies as available_copies_count' => function ($query) {
                $query->where('status', 'available');
            },
        ])
            ->having('available_copies_count', '>', 0)
            ->orderBy('title')
            ->get();

        return view('layouts.admin.borrow-records.borrow-records-create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'book_id' => ['required', 'exists:books,id'],
            'borrow_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:borrow_date'],
        ]);

        $copy = BookCopy::where('book_id', $data['book_id'])
            ->where('status', 'available')
            ->first();

        if (!$copy) {
            return back()
                ->withInput()
                ->with('error', 'No available copies for this book.');
        }

        BorrowRecord::create([
            'member_id' => $data['member_id'],
            'book_copy_id' => $copy->id,
            'borrow_date' => $data['borrow_date'],
            'due_date' => $data['due_date'],
        ]);

        $copy->update([
            'status' => 'borrowed',
        ]);

        return redirect()
            ->route('admin.borrow-records')
            ->with('success', 'Book borrowed successfully.');
    }

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