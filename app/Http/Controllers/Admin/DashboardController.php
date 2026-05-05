<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\BorrowRecord;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $borrowedBooks = BookCopy::where('status', 'borrowed')->count();
        $pendingReturns = BookCopy::where('status', 'pending_return')->count();

        $recentBorrowRecords = BorrowRecord::with(['member', 'copy.book'])
            ->latest()
            ->take(8)
            ->get();

        return view('layouts.admin.index', compact(
            'totalBooks',
            'totalMembers',
            'borrowedBooks',
            'pendingReturns',
            'recentBorrowRecords'
        ));
    }
}