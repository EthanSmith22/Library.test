<?php

use Illuminate\Support\Facades\Route;

Route::domain(config('app.author_domain'))->group(function () {
    Route::get('/', function () {
        return "author Panel";
    });
});