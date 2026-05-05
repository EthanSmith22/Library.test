<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BorrowController;
use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.admin_domain'))->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/pending-returns', [BorrowController::class, 'pendingReturns'])
        ->name('admin.pending-returns');

    Route::post('/borrowings/{borrowRecord}/confirm-return', [BorrowController::class, 'confirmReturn'])
        ->name('admin.borrowings.confirm-return');

    // ✅ Books
    Route::get('/books', [BookController::class, 'index'])
        ->name('admin.books');
});