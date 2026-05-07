<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookStand;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookStandController extends Controller
{
    public function index()
    {
        $stands = BookStand::withCount('copies')
            ->latest()
            ->get();

        return view('layouts.admin.book-stands.book-stands', compact('stands'));
    }

    public function create()
    {   
        $genres = Genre::orderBy('name')->get();

        return view('layouts.admin.book-stands.book-stands-create', compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:book_stands,code'],
            'floor' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        BookStand::create($data);

        return redirect()->route('admin.book-stands')->with('success', 'Book stand created successfully.');
    }

    public function edit(BookStand $bookStand)
    {
        $genres = Genre::orderBy('name')->get();

        return view('layouts.admin.book-stands.book-stands-edit', compact('bookStand', 'genres'));
    }

    public function update(Request $request, BookStand $bookStand)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:book_stands,code,' . $bookStand->id],
            'floor' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $bookStand->update($data);

        return redirect()->route('admin.book-stands')->with('success', 'Book stand updated successfully.');
    }

    public function destroy(BookStand $bookStand)
    {
        $bookStand->delete();

        return redirect()->route('admin.book-stands')->with('success', 'Book stand deleted successfully.');
    }
}