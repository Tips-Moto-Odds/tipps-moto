<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/about', function () { return Inertia::render('Home/about'); })->name('about');
Route::get('/contact', function () { return Inertia::render('Home/contactUs'); })->name('contactUs');

Route::get('/TermsOfService', function () { return Inertia::render('Home/TermsOfService'); })->name('TermsAndConditions');
Route::get('/PrivacyPolicy', function () { return Inertia::render('Home/PrivacyPolicy'); })->name('PrivacyPolicy');

Route::post('initiateTransaction',[MpesaController::class,'initiateTransaction'])->name('initiateTransaction');



