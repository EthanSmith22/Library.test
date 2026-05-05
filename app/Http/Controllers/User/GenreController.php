<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::withCount('books')->latest()->get();
    
        $selectedGenres = $request->input('genres', []);
    
        $books = Book::with(['author', 'genres', 'copies'])
            ->when(!empty($selectedGenres), function ($query) use ($selectedGenres) {
                $query->whereHas('genres', function ($genreQuery) use ($selectedGenres) {
                    $genreQuery->whereIn('genres.id', $selectedGenres);
                });
            })
            ->latest()
            ->get();
    
        return view('layouts.user.genres', compact('genres', 'books', 'selectedGenres'));
    }
}
