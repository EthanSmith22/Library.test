<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::orderBy('name')->get();

        $books = Book::with(['author', 'genres', 'copies'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhereHas('author', function ($authorQuery) use ($search) {
                            $authorQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->genre, function ($query, $genreId) {
                $query->whereHas('genres', function ($genreQuery) use ($genreId) {
                    $genreQuery->where('genres.id', $genreId);
                });
            })
            ->when($request->status === 'available', function ($query) {
                $query->whereHas('copies', function ($copyQuery) {
                    $copyQuery->where('status', 'available');
                });
            })
            ->when($request->status === 'unavailable', function ($query) {
                $query->whereDoesntHave('copies', function ($copyQuery) {
                    $copyQuery->where('status', 'available');
                });
            })
            ->latest()
            ->get();

        return view('layouts.user.books', compact('books', 'genres'));
    }

    public function show(Book $book)
    {
        $book->load(['author', 'genres', 'copies.stand']);

        return view('layouts.user.book-detail', compact('book'));
    }
}