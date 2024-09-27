<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

include_once "OpenRoutes/index.php";
include_once "GuestRoutes/index.php";
include_once "DashboardLinks/index.php";
include_once "USSD/index.php";


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //list account types view
    Route::get('/Profile', [ProfileController::class, 'index'])->name('ViewProfile');

});
