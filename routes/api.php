<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\OnitController;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('/onit/response', function () {
    Log::info(request()->all());
})->name('');

Route::post('/onit/deposit/response', [OnitController::class, 'confirmPayment']);

Route::post('/onit/withdraw/response', function () {
    Log::info(request()->all());
});

Route::post('/postTips', AutomationController::class);

Route::get('/users', function (Request $request) {
    return [];
})->middleware('auth:sanctum');

Route::get('/users/{user}', fn (Request $request, User $user) => $user )->middleware('auth:sanctum');

Route::resource('/affiliates', AffiliateController::class)->only(['store', 'update', 'destroy']);
Route::post('/affiliates/add-user', [AffiliateController::class,'add_user']);
Route::post('/affiliates/add-purchase', [AffiliateController::class,'add_purchase']);



