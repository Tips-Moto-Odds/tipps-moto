<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {


    //Profile
    Route::get('/account', function () {
        return Inertia::render('Dashboard');
    })->name('account');

    Route::get('/settings', function () {
        return Inertia::render('Dashboard');
    })->name('settings');

    //Manage

    Route::get('/tips', function () {
        return Inertia::render('Dashboard');
    })->name('tips');

    Route::get('/transactions', function () {
        return Inertia::render('Dashboard');
    })->name('ManageTransactions');

    Route::get('/notifications', function () {
        return Inertia::render('Dashboard');
    })->name('notifications');

    //Administration
    Route::get('/model', function () {
        return Inertia::render('Dashboard');
    })->name('model');

    Route::get('/system', function () {
        return Inertia::render('Dashboard');
    })->name('system');


    include_once "AccountTypes.php";
    include_once "Profile_Account.php";
    include_once "Tips.php";
    include_once "Football/Views.php";
    include_once "transactions.php";

});







