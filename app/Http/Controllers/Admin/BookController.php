<?php

namespace App\Http\Controllers\Admin;

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
            ->when($request->status, function ($query, $status) {
                if ($status === 'unavailable') {
                    $query->whereDoesntHave('copies', function ($copyQuery) {
                        $copyQuery->where('status', 'available');
                    });
                } else {
                    $query->whereHas('copies', function ($copyQuery) use ($status) {
                        $copyQuery->where('status', $status);
                    });
                }
            })
            ->latest()
            ->get();
    
        return view('layouts.admin.books', compact('books', 'genres'));
    }
}