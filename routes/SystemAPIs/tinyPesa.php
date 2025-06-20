<?php

use App\Http\Controllers\TinyPesaWebhookController;
use App\Http\Controllers\TransactionController;

use Illuminate\Support\Facades\Route;


Route::post('/tinypesa/confirmPayment', [
    TransactionController::class,
    'confirmTinyPesaPayment'
])
    ->middleware('auth')
    ->name('confirmTinyPesaPayment');


Route::post('/tinyPesa/response', [TinyPesaWebhookController::class, 'handle'])
    ->name('tinyPesa.response');


