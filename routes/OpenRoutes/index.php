<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PackagesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return Inertia::render('Home/about');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Home/contactUs');
})->name('contactUs');

Route::get('/packages', [PackagesController::class, 'index'])->name('packages');

Route::get('/packages/user_subscribe/{sub}', [PackagesController::class, 'subscribe_view'])->name('userSubscribe')
    ->middleware(['auth:sanctum'])
;

Route::get('/TermsOfService', function () {
    return Inertia::render('Home/TermsOfService');
})->name('TermsAndConditions');
Route::get('/PrivacyPolicy', function () {
    return Inertia::render('Home/PrivacyPolicy');
})->name('PrivacyPolicy');

Route::get('/marketing/{page?}', [MarketingController::class, 'index']);






