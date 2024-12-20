<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contactUs'])->name('contact');

Route::get('/packages', [HomeController::class, 'packages'])->name('packages');

Route::get('/packages/subscribe/{sub}', [HomeController::class, 'subscribeView'])->name('userSubscribe')->middleware(['auth:sanctum']);

Route::get('/termsOfService', [HomeController::class, 'termsOfService'])->name('termsAndConditions');

Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

//Route::get('/marketing/{page?}', [MarketingController::class, 'index']);






