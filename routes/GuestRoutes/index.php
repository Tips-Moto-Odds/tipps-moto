<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {

    Route::get('/sign-up', function () {
        return Inertia::render('Home/SignUp');
    })
         ->name('sign-up');

    Route::get('/sign-in', function () {
        return Inertia::render('Home/SignIn');
    })
         ->name('sign-in');

});
