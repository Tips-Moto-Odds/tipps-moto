<?php

use App\Http\Controllers\HomeController;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/privacyPolicy', 'privacyPolicy')->name('privacyPolicy');
    Route::get('/termsOfService', 'termsOfService')->name('termsAndConditions');
});

Route::group(['prefix' => 'market'], function () {
    Route::get('/', function (Request $request) {
        return Inertia::render('Home/Markets/Pages/index', [
            'markets' => []
        ]);
    })->name('markets');

    Route::get('/football', function (Request $request) {
        $packages = Packages::all();
        $balance = null;

        if (Auth::user()) {
            $balance = Auth::user()->latest_balance_value;
        }

        return Inertia::render('Home/Markets/Pages/Football', [
            'packages' => $packages,
            'balance' => $balance
        ]);
    })->name('markets.football');

    Route::get('/formula-one', function (Request $request) {
        return Inertia::render('Home/Markets/Pages/FromularOne', [
            'markets' => []
        ]);
    })->name('markets.formulaOne');

    Route::get('/swimming', function (Request $request) {
        return Inertia::render('Home/Markets/Pages/Swimming', [
            'markets' => []
        ]);
    })->name('markets.swimming');

    Route::get('/track-and-field', function (Request $request) {
        return Inertia::render('Home/Markets/Pages/TrackAndField', [
            'markets' => []
        ]);
    })->name('markets.trackAndField');

    Route::get('/cycling', function (Request $request) {
        return Inertia::render('Home/Markets/Pages/Cycling', [
            'markets' => []
        ]);
    })->name('markets.cycling');
});

//Route::get('/contact', [HomeController::class, 'contactUs'])->name('contact');
//Route::get('/packages', [HomeController::class, 'packages'])->name('packages');
//Route::get('/packages/subscribe/{sub}', [HomeController::class, 'subscribeView'])->name('userSubscribe')->middleware(['auth:sanctum']);
////Route::get('/marketing/{page?}', [MarketingController::class, 'index']);






