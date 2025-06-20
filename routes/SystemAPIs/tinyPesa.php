<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('/tinypesa/confirmPayment', [
    TransactionController::class,
    'confirmTinyPesaPayment'
])
    ->middleware('auth')
    ->name('confirmTinyPesaPayment');

Route::post('/tinyPesa/response', function (Request $request) {
    Log::info($request->all());
})
    ->name('');
