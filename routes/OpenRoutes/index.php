<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('Home');

Route::get('/test', [TestController::class, 'index'])->name('home');

Route::get('/tips', [HomeController::class, 'tips'])->name('tips');

Route::get('/free-week-tips',function(){
    return Inertia::render('LandingPages/landing-1');
})->name('free-week-tips');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

Route::get('/termsOfService', [HomeController::class, 'termsOfService'])->name('termsAndConditions');

//Route::get('/contact', [HomeController::class, 'contactUs'])->name('contact');
//Route::get('/packages', [HomeController::class, 'packages'])->name('packages');
//Route::get('/packages/subscribe/{sub}', [HomeController::class, 'subscribeView'])->name('userSubscribe')->middleware(['auth:sanctum']);
////Route::get('/marketing/{page?}', [MarketingController::class, 'index']);






