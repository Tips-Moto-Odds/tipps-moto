<?php

use App\Http\Controllers\AccountsTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix('dashboard/AccountTypes')->as('dashboard.AccountTypes.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});

