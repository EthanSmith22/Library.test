<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = \App\Models\Author::withCount('books')->latest()->get();

        return view('layouts.user.authors', compact('authors'));
    }

    public function show(\App\Models\Author $author)
    {
        $author->load('books.genres');
    
        return view('layouts.user.author-detail', compact('author'));
    }
}
