<?php

use App\Http\Middleware\CheckUserId;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckUserId::class.':5']) // ✅ Corrected syntax
->prefix('Dashboard/Users')
    ->as('dashboard.user.')
    ->group(function () {
        include_once "Views.php";
        include_once "Actions.php";
    });
