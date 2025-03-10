<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/transactions')->as('dashboard.transactions.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});


