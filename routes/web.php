<?php

use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\AuthorController;
use App\Http\Controllers\User\GenreController;
use App\Http\Controllers\User\BorrowController;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.project_domain'))->group(function () {
    Route::get('/', function () {
        $books = Book::with(['author', 'genres', 'copies'])
        ->latest()
        ->take(3)
        ->get();

    $authors = Author::withCount('books')
        ->latest()
        ->take(3)
        ->get();

    $genres = Genre::withCount('books')
        ->latest()
        ->take(8)
        ->get();

    return view('layouts.user.index', compact('books', 'authors', 'genres'));
    })->name('user.home');
 
    //Books
    Route::get('/books', [BookController::class, 'index'])->name('user.books');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('user.books.show');
    //Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('user.authors');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('user.authors.show');
    //Genres
    Route::get('/genres', [GenreController::class, 'index'])->name('user.genres');
    //About
    Route::get('/about', function () {return view('layouts.user.about');})->name('user.about');

    //login && signup
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Borrow
    Route::post('/books/{book}/borrow', [BorrowController::class, 'borrow'])->name('user.books.borrow');

    Route::get('/my-borrowings', [BorrowController::class, 'index'])->name('user.borrowings');

    Route::post('/borrowings/{borrowRecord}/request-return', [BorrowController::class, 'requestReturn'])
    ->name('user.borrowings.request-return');
    Route::post('/borrowings/{borrowRecord}/cancel-return', [BorrowController::class, 'cancelReturn'])
    ->name('user.borrowings.cancel-return');

    
});    
