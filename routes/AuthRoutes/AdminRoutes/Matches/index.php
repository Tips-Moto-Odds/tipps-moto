<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/matches')->as('dashboard.matches.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});




