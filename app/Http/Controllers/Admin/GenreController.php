<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::withCount('books')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('layouts.admin.genres.genres', compact('genres'));
    }

    public function create()
    {
        return view('layouts.admin.genres.genres-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genres,name'],
            'description' => ['nullable', 'string'],
        ]);

        Genre::create($data);

        return redirect()->route('admin.genres')->with('success', 'Genre created successfully.');
    }

    public function edit(Genre $genre)
    {
        return view('layouts.admin.genres.genres-edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genres,name,' . $genre->id],
            'description' => ['nullable', 'string'],
        ]);

        $genre->update($data);

        return redirect()->route('admin.genres')->with('success', 'Genre updated successfully.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres')->with('success', 'Genre deleted successfully.');
    }
}