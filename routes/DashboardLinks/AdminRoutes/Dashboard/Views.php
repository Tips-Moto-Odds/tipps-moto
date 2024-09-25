<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    //get to dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

});







