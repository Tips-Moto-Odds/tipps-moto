<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', function () { return Inertia::render('Welcome'); })->name('home');
Route::get('/about', function () { return Inertia::render('Home/about'); })->name('about');
Route::get('/contact', function () { return Inertia::render('Home/contactUs'); })->name('contactUs');

Route::get('/TermsOfService', function () { return Inertia::render('Home/TermsOfService'); })->name('TermsAndConditions');
Route::get('/PrivacyPolicy', function () { return Inertia::render('Home/PrivacyPolicy'); })->name('PrivacyPolicy');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-up', function () { return Inertia::render('Home/SignUp'); })->name('sign-up');
    Route::get('/sign-in', function () { return Inertia::render('Home/SignIn'); })->name('sign-in');
});
