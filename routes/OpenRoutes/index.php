<?php

use App\Http\Controllers\HomeController;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('Home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

Route::get('/termsOfService', [HomeController::class, 'termsOfService'])->name('termsAndConditions');

Route::get('/fb-give-away', function () {
    return Inertia::render('LandingPages/fbPromo1');
})->name('free-week-tips');

Route::get('/free-week-tips', function () {
    return Inertia::render('LandingPages/landing-1');
})->name('free-week-tips');

Route::post('/fb-give-away', function (Request $request) {

    // Validate request data, including the date
    $validatedData = $request->validate([
        'facebookName' => 'required|string|max:255',
        'whatsappNumber' => 'required|string|max:20',
        'email' => 'required|email|max:255',
    ]);

    // Insert data into the database
    DB::table('FacebookGiveAway')->insert([
        'facebookName' => $validatedData['facebookName'],
        'whatsAppNumber' => $validatedData['whatsappNumber'],
        'email' => $validatedData['email'],
    ]);

    return response()->json([
        'message' => 'Data submitted successfully!',
        'redirect_url' => 'https://whatsapp.com/channel/0029VagdQJFBfxo8DiYaBI06',
    ]);

})->name('free-week-tips');

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

        return Inertia::render('Home/Tips', [
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






