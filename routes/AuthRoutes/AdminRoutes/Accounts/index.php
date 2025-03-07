<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('dashboard/user')->as('dashboard.user.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});




