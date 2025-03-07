<?php

use App\Http\Controllers\AccountsTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {

        //Manage Football Teams
        Route::get('/ManageFootballTeams', [FootballController::class, 'index'])->name('ManageFootballTeams');

        include_once "Views.php";
        include_once "Actions.php";

    });

