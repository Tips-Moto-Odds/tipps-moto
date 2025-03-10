<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckUserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([CheckUserId::class . ':2'])
    ->prefix('dashboard/profile')->as('dashboard.profile.')->group(function () {
        include_once "Views.php";
    });





