<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\OnitController;
use App\Http\Controllers\TinpesaController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::post('/onit/response', function () {
    Log::info(request()->all());
})->name('');


Route::post('/tinyPesa/response', function () {
    return request()->all();
})->name('');

Route::post('/onit/deposit/response', [OnitController::class, 'confirmPayment']);

Route::post('/onit/withdraw/response', function () {
    Log::info(request()->all());
});

Route::post('/postTips', AutomationController::class);

Route::get('/users', function (Request $request) {
    return [];
})->middleware('auth:sanctum');

Route::get('/users/{user}', fn(Request $request, User $user) => $user)->middleware('auth:sanctum');

Route::get('/testing', function (Request $request) {

});

Route::get('/get-subscriptions', function () {
    return DB::table('browser_push_subscriptions')->get(['endpoint', 'p256dh', 'auth']);
});

Route::post('/remove-subscription', function (Request $request) {
    $endpoint = $request->input('endpoint');

    DB::table('browser_push_subscriptions')->where('endpoint', $endpoint)->delete();

    return response()->json(['status' => 'deleted']);
});

// Route to redirect to Google's OAuth page
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');

// Route to handle the callback from Google
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::resource('/affiliates', AffiliateController::class)->only(['store', 'update', 'destroy']);
Route::post('/affiliates/add-user', [AffiliateController::class, 'add_user']);
Route::post('/affiliates/add-purchase', [AffiliateController::class, 'add_purchase']);
