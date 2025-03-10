<?php

use App\Http\Middleware\CheckUserId;
use Illuminate\Support\Facades\Route;


Route::middleware([CheckUserId::class . ':5'])
    ->prefix('dashboard/selection')->as('dashboard.selection.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});





