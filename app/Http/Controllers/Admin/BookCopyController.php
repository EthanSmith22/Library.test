<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\BookStand;
use Illuminate\Http\Request;

class BookCopyController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::orderBy('title')->get();
        $stands = BookStand::orderBy('code')->get();

        $copies = BookCopy::with(['book.author', 'stand'])
            ->when($request->search, function ($query, $search) {
                $query->where('accession_no', 'like', "%{$search}%")
                    ->orWhereHas('book', function ($bookQuery) use ($search) {
                        $bookQuery->where('title', 'like', "%{$search}%");
                    });
            })
            ->when($request->book_id, function ($query, $bookId) {
                $query->where('book_id', $bookId);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->get();

        return view('layouts.admin.copies.copies', compact('copies', 'books', 'stands'));
    }

    public function create()
    {
        $books = Book::orderBy('title')->get();
        $stands = BookStand::orderBy('code')->get();

        return view('layouts.admin.copies.copies-create', compact('books', 'stands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'book_stand_id' => ['nullable', 'exists:book_stands,id'],
            'accession_no' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'condition' => ['required', 'in:new,good,fair,damaged'],
            'status' => ['required', 'in:available,borrowed,pending_return,reserved,lost,damaged'],
        ]);
    
        $created = 0;
    
        for ($i = 1; $i <= $data['quantity']; $i++) {
            $accessionNo = strtoupper($data['accession_no']) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);
    
            if (BookCopy::where('accession_no', $accessionNo)->exists()) {
                continue;
            }
    
            BookCopy::create([
                'book_id' => $data['book_id'],
                'book_stand_id' => $data['book_stand_id'],
                'accession_no' => $accessionNo,
                'condition' => $data['condition'],
                'status' => $data['status'],
            ]);
    
            $created++;
        }
    
        return redirect()
            ->route('admin.copies')
            ->with('success', $created . ' book copies created successfully.');
    }

    public function edit(BookCopy $copy)
    {
        $books = Book::orderBy('title')->get();
        $stands = BookStand::orderBy('code')->get();

        return view('layouts.admin.copies.copies-edit', compact('copy', 'books', 'stands'));
    }

    public function update(Request $request, BookCopy $copy)
    {
        $data = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'book_stand_id' => ['nullable', 'exists:book_stands,id'],
            'accession_no' => ['required', 'string', 'max:255', 'unique:book_copies,accession_no,' . $copy->id],
            'condition' => ['required', 'in:new,good,fair,damaged'],
            'status' => ['required', 'in:available,borrowed,pending_return,reserved,lost,damaged'],
        ]);

        $copy->update($data);

        return redirect()->route('admin.copies')->with('success', 'Book copy updated successfully.');
    }

    public function destroy(BookCopy $copy)
    {
        $copy->delete();

        return redirect()->route('admin.copies')->with('success', 'Book copy deleted successfully.');
    }
}