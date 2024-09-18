<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ClientController;
use Illuminate\Support\Facades\Route as Route;

Route::post('/authenticate', [ClientController::class, 'authenticate']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/account/create', function (Request $request) {
        dd($request);
        return response()->json(['message' => 'Route is working']);
    });
});

//Route::post('/account/create', function (Request $request) {
//    dd($request);
//    return response()->json(['message' => 'Route is working']);
//});

//Transaction Initiation
//Callback URL for Payment Status Notification
//Account Balance Check
//Account Status Check (Active or Dormant)
//Account Activation and Deactivation
//Transaction History
//Recurring Payments Setup
