<?php

use App\Http\Controllers\AccountsTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {


        include_once "Views.php";
        include_once "Actions.php";

    });

