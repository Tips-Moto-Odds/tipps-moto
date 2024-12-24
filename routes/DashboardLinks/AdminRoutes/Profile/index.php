<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('dashboard/profile')->as('dashboard.profile.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});





