<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::prefix('/USSD')->group(function () {
    Route::post('/', function (Request $request) {
        // Set header for content-type as text/plain

        return response($responseText)
            ->header('Content-Type', 'text/plain');
    });

    Route::post('/Callback', function (Request $request) {
        // Set header for content-type as text/plain
        $responseText = "END Welcome to TipsMoto! \n1. Football \n2. Cricket \n3. Basketball \n4. Hockey \n5. Exit END";

        return response($responseText)
            ->header('Content-Type', 'text/plain');
    });
});

