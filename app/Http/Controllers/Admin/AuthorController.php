<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = Author::withCount('books')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('layouts.admin.authors.authors', compact('authors'));
    }

    public function create()
    {
        return view('layouts.admin.authors.authors-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
        ]);

        Author::create($data);

        return redirect()->route('admin.authors')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author)
    {
        return view('layouts.admin.authors.authors-edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
        ]);

        $author->update($data);

        return redirect()->route('admin.authors')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors')->with('success', 'Author deleted successfully.');
    }
}