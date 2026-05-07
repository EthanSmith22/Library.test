<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
            public function index(Request $request)
            {
                $genres = Genre::orderBy('name')->get();
        
                $books = Book::with(['author', 'genres'])
            ->withCount([
                'copies',
                'copies as available_copies_count' => function ($query) {
                    $query->where('status', 'available');
                },
                'copies as borrowed_copies_count' => function ($query) {
                    $query->where('status', 'borrowed');
                },
            ])
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

        return view('layouts.admin.books.books', compact('books', 'genres'));
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();

        return view('layouts.admin.books.books-create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_id' => ['required', 'exists:authors,id'],
            'genres' => ['nullable', 'array'],
            'genres.*' => ['exists:genres,id'],
            'isbn' => ['nullable', 'string', 'max:255', 'unique:books,isbn'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:255'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'edition' => ['nullable', 'string', 'max:255'],
            'released_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }

        $book = Book::create($data);

        $book->genres()->sync($data['genres'] ?? []);

        return redirect()->route('admin.books')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $book->load('genres');

        $authors = Author::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();

        return view('layouts.admin.books.books-edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_id' => ['required', 'exists:authors,id'],
            'genres' => ['nullable', 'array'],
            'genres.*' => ['exists:genres,id'],
            'isbn' => ['nullable', 'string', 'max:255', 'unique:books,isbn,' . $book->id],
            'publisher' => ['nullable', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:255'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'edition' => ['nullable', 'string', 'max:255'],
            'released_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }

        $book->update($data);

        $book->genres()->sync($data['genres'] ?? []);

        return redirect()->route('admin.books')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Book deleted successfully.');
    }
}