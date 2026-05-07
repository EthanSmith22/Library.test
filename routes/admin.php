<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BorrowController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookCopyController;
use App\Http\Controllers\Admin\BookStandController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.admin_domain'))
    ->middleware(['admin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/pending-returns', [BorrowController::class, 'pendingReturns'])
            ->name('admin.pending-returns');

        Route::post('/borrowings/{borrowRecord}/confirm-return', [BorrowController::class, 'confirmReturn'])
            ->name('admin.borrowings.confirm-return');

        //BOOKS site 
        Route::get('/books', [BookController::class, 'index'])->name('admin.books');
        Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');

        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        //BOOK COPIES site
        Route::get('/copies', [BookCopyController::class, 'index'])->name('admin.copies');
        Route::get('/copies/create', [BookCopyController::class, 'create'])->name('admin.copies.create');
        Route::post('/copies', [BookCopyController::class, 'store'])->name('admin.copies.store');
        Route::get('/copies/{copy}/edit', [BookCopyController::class, 'edit'])->name('admin.copies.edit');
        Route::put('/copies/{copy}', [BookCopyController::class, 'update'])->name('admin.copies.update');
        Route::delete('/copies/{copy}', [BookCopyController::class, 'destroy'])->name('admin.copies.destroy');

        //BOOK STANDS site
        Route::get('/book-stands', [BookStandController::class, 'index'])->name('admin.book-stands');
        Route::get('/book-stands/create', [BookStandController::class, 'create'])->name('admin.book-stands.create');
        Route::post('/book-stands', [BookStandController::class, 'store'])->name('admin.book-stands.store');
        Route::get('/book-stands/{bookStand}/edit', [BookStandController::class, 'edit'])->name('admin.book-stands.edit');
        Route::put('/book-stands/{bookStand}', [BookStandController::class, 'update'])->name('admin.book-stands.update');
        Route::delete('/book-stands/{bookStand}', [BookStandController::class, 'destroy'])->name('admin.book-stands.destroy');


        //BORROW RECORDS site
        Route::get('/borrow-records', [BorrowController::class, 'index'])->name('admin.borrow-records');
        Route::get('/borrow-records/create', [BorrowController::class, 'create'])->name('admin.borrow-records.create');
        Route::post('/borrow-records', [BorrowController::class, 'store'])->name('admin.borrow-records.store');

        //MEMBERS site
        Route::get('/members', [MemberController::class, 'index'])->name('admin.members');
        Route::get('/members/create', [MemberController::class, 'create'])->name('admin.members.create');
        Route::post('/members', [MemberController::class, 'store'])->name('admin.members.store');
        Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('admin.members.edit');
        Route::put('/members/{member}', [MemberController::class, 'update'])->name('admin.members.update');
        Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('admin.members.destroy');

        //GENRES site
        Route::get('/genres', [GenreController::class, 'index'])->name('admin.genres');
        Route::get('/genres/create', [GenreController::class, 'create'])->name('admin.genres.create');
        Route::post('/genres', [GenreController::class, 'store'])->name('admin.genres.store');
        Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('admin.genres.edit');
        Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('admin.genres.update');
        Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('admin.genres.destroy');

        //AUTHORS site
        Route::get('/authors', [AuthorController::class, 'index'])->name('admin.authors');
        Route::get('/authors/create', [AuthorController::class, 'create'])->name('admin.authors.create');
        Route::post('/authors', [AuthorController::class, 'store'])->name('admin.authors.store');
        Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('admin.authors.edit');
        Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('admin.authors.update');
        Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');
});