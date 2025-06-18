<?php

use App\Http\Controllers\AutomationController;
use App\Http\Controllers\TransactionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::post('/payWithAvailableBalance', [TransactionController::class, 'payWithAvailableBalance'])->name('');

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

include "SystemAPIs/affiliates.php";
include "SystemAPIs/google.php";
include "SystemAPIs/onit.php";
include "SystemAPIs/tinyPesa.php";
