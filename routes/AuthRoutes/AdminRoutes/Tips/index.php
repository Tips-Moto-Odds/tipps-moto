<?php

use Illuminate\Support\Facades\Route;


Route::prefix('dashboard/tips')->as('dashboard.tips.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});





