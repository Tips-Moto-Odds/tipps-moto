<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('dashboard/transactions')->as('dashboard.transactions.')->group(function () {
    include_once "Views.php";
    include_once "Actions.php";
});


