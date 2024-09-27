<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::prefix('/USSD')->group(function () {
    Route::post('/', function (Request $request) {
        return "Thank you for using our service END";
    });
});
