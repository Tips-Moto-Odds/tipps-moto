<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    include_once 'Dashboard/index.php';

    include_once 'Accounts/index.php';
    include_once 'AccountTypes/index.php';
    include_once 'Dashboard/index.php';
    include_once 'Football/index.php';
    include_once 'Profile/index.php';
    include_once 'Teams/index.php';
    include_once 'Tips/index.php';
    include_once 'Transactions/index.php';
});







