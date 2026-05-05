<?php

namespace App\Http\Controllers\User;

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
        if (! session('member_id')) {
            return redirect()->route('login');
        }

        $member = Member::findOrFail(session('member_id'));

        $borrowRecords = BorrowRecord::with(['copy.book.author', 'copy.stand'])
            ->where('member_id', $member->id)
            ->latest()
            ->get();

        return view('layouts.user.my-borrowings', compact('member', 'borrowRecords'));
    }

    public function borrow(Book $book)
    {
        if (! session('member_id')) {
            return redirect()->route('login');
        }

        $availableCopy = BookCopy::where('book_id', $book->id)
            ->where('status', 'available')
            ->first();

        if (! $availableCopy) {
            return back()->with('error', 'No available copies for this book.');
        }

        BorrowRecord::create([
            'member_id' => session('member_id'),
            'book_copy_id' => $availableCopy->id,
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(14)->toDateString(),
            'return_date' => null,
        ]);

        $availableCopy->update([
            'status' => 'borrowed',
        ]);

        return redirect()->route('user.borrowings')
            ->with('success', 'Book borrowed successfully.');
    }
    public function requestReturn(\App\Models\BorrowRecord $borrowRecord)
    {
        if (! session('member_id')) {
            return redirect()->route('login');
        }
    
        if ($borrowRecord->member_id !== session('member_id')) {
            abort(403);
        }
    
        if ($borrowRecord->return_date) {
            return back()->with('error', 'Already returned.');
        }
    
        if ($borrowRecord->copy->status !== 'borrowed') {
            return back()->with('error', 'Cannot request return.');
        }
    
        $borrowRecord->copy->update([
            'status' => 'pending_return',
        ]);
    
        return back()->with('success', 'Return request submitted.');
    }
    public function cancelReturn(\App\Models\BorrowRecord $borrowRecord)
    {
        if (! session('member_id')) {
            return redirect()->route('login');
        }

        if ($borrowRecord->member_id !== session('member_id')) {
            abort(403);
        }

        if ($borrowRecord->return_date) {
            return back()->with('error', 'This book has already been returned.');
        }

        if ($borrowRecord->copy?->status !== 'pending_return') {
            return back()->with('error', 'No pending return request to cancel.');
        }

        $borrowRecord->copy->update([
            'status' => 'borrowed',
        ]);

        return back()->with('success', 'Return request cancelled.');
    }
}