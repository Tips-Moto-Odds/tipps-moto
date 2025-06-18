<?php


use App\Http\Controllers\OnitController;
use Illuminate\Support\Facades\Route;


Route::post('/onit/response', function () {
    Log::info(request()->all());
})->name('');

Route::post('/onit/deposit/response', [OnitController::class, 'confirmPayment']);


Route::post('/onit/withdraw/response', function () {
    Log::info(request()->all());
});
