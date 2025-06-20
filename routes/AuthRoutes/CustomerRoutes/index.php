<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//user links
Route::group(['prefix' => 'Profile'], function () {

    // Patch user details
    Route::patch('/update/{user}', [CustomerController::class, 'patchUser'])->name('UpdateUser');

    // Patch password
    Route::patch('/update-password/{user}', [CustomerController::class, 'patchPassword'])->name('UpdatePassword');

    //----------------------------------------------------------------------------------------------------------------------

    //List of subscriptions
    Route::get('/subscription', [CustomerController::class, 'subscriptions'])->name('profile.subscription');

    Route::post('/subscribe',[CustomerController::class,'subscribe'])->name('subscribe');

    Route::get('/subscription/Tips/{selection}', [CustomerController::class, 'subscriptions_tip'])->name('profile.tips');


    //----------------------------------------------------------------------------------------------------------------------


    Route::get('/affiliateTermsAndConditions', static fn() => Inertia::render('UserPanel/affiliateTermsAndConditions'))->name('affiliateTermsAndConditions');

    Route::post('/affiliate/join',[CustomerController::class,'joinAffiliate'])->name('affiliate.join');

});
