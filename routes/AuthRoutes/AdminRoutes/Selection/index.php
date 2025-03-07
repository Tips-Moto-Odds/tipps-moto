<?php

use Illuminate\Support\Facades\Route;


Route::prefix('dashboard/selection')->as('dashboard.selection.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});





