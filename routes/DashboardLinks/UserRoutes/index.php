<?php /** @noinspection ALL */

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\SubscriptionController;



/**
 * ProfileController
 * --------------------------------
 * */
Route::group(['prefix' => 'profile'], function () {
    // Patch user details
    Route::patch('/update/{user}', [ProfileController::class, 'patch'])->name('UpdateUser');

    // Patch password
    Route::patch('/update-password/{user}', [ProfileController::class, 'patchPassword'])->name('UpdatePassword');
});


/**
 * TipsController
 * --------------------------------
 * */
Route::group(['prefix' => 'tips'], function () {
    //view Tip
    Route::get('/tips/{tip}', [TipsController::class,'view'])->name('viewTip');

    //subscribe to Packages
    Route::post('/app/subscribe', [SubscriptionController::class,'subscribe'])->name('subscribe');

    //unsubscribe from Packages  (Auth required)
    Route::post('/app/unsubscribe', [SubscriptionController::class,'unsubscribe'])->name('unsubscribe');
});
