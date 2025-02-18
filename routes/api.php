<?php

use App\Http\Controllers\AutomationController;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('/onit/response', function () {
    Log::info(request()->all());
})->name('');

Route::post('/onit/deposit/response', function (Request $request) {
    if ($request->has('originatorRequestId')) {
        $transaction_string = $request->input('originatorRequestId');
        $code = explode('|', $transaction_string);
        $code = $code[1];

        $transaction = Transaction::where('transaction_reference', $code)->first();

        if ($transaction) {
            $transaction->transaction_status = 'successful';

            $package = Packages::find($transaction->package_id);
            $endDate = now()->addDays($package->period);

            $subscription = new Subscription();
            $subscription->user_id = $transaction->user_id;
            $subscription->package_id = $package->id;
            $subscription->start_date = now()->format('Y-m-d');
            $subscription->end_date = $endDate->format('Y-m-d');
            $subscription->status = 'active';
            $subscription->transaction_id = $transaction->id;

            $transaction->save();
            $subscription->save();
        } else {
            Log::info("Transaction not found");
        }
    } else {
        dd('Transaction failed');
    }
})->name('');

Route::post('/onit/withdraw/response', function () {
    Log::info(request()->all());
})->name('');

Route::post('/postTips', AutomationController::class);

Route::get('/users', function (Request $request) {

})->middleware('auth:sanctum');


