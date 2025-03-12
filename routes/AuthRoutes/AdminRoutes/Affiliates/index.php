<?php

use App\Http\Middleware\CheckUserId;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckUserId::class.':5'])
->prefix('Dashboard/Affiliates')
    ->as('dashboard.Affiliates.')
    ->group(function () {
        include_once "Views.php";
        include_once "Actions.php";
    });
