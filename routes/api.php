<?php

use App\Http\Controllers\AutomationController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::post('/payWithAvailableBalance', [TransactionController::class, 'payWithAvailableBalance'])->name('');

Route::post('/postTips', AutomationController::class);


include "SystemAPIs/affiliates.php";
include "SystemAPIs/google.php";
include "SystemAPIs/onit.php";
include "SystemAPIs/tinyPesa.php";
include "SystemAPIs/pushNotificationsApi.php";
