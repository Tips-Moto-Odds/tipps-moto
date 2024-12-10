<?php

use App\Models\Tips;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;

include_once "OpenRoutes/index.php";
include_once "GuestRoutes/index.php";
include_once "DashboardLinks/index.php";

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    //user links
    Route::group(['prefix' => 'Profile'], function () {
        //get to profile
        Route::get('/', [ProfileController::class, 'index'])->name('Profile');

        // Patch user details
        Route::patch('/update/{user}', [ProfileController::class, 'patch'])->name('UpdateUser');

        // Patch password
        Route::patch('/update-password/{user}', [ProfileController::class, 'patchPassword'])->name('UpdatePassword');
    });


    Route::group(['prefix' => 'ManageTips'], function () {
        Route::get('/Tips', function () {
            dd("here");
        })->name('Tips');
        //view Tip
        Route::get('/tips/{tip}', [TipsController::class, 'view'])->name('viewTip');
    });


    //tips
    Route::get('/Tips', function () {
        $tips = [];
        //find the users subscriptions
        $user_data['subscriptions_details'] = Auth::user()->active_subscription;

        if (Auth::user()->active_subscription) {
            $tips = Tips::orderBy('match_start_time', 'desc')->paginate(10);
        }

        return Inertia::render('Users/Tips/Index', [
            'tips'      => $tips,
            'user_data' => $user_data
        ]);
    })->name('Tips');
    //subscribe to Packages
    Route::post('/app/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    //unsubscribe from Packages  (Auth required)
    Route::post('/app/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

    //wallet
    Route::get('/Wallet', function () {
        return Inertia::render('Users/Wallet/Index');
    })->name('Wallet');
});
