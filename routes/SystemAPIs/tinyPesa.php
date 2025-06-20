<?php

use App\Http\Controllers\TransactionController;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
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
    $payload = $request->all();
    Log::info('TinyPesa Webhook:', $payload);

    try {
        $callback = $payload[0]['Body']['stkCallback'] ?? null;
        if (!$callback) {
            Log::warning('Invalid TinyPesa callback format.');
            return response()->json(['message' => 'Invalid format'], 400);
        }

        $externalRef = $callback['ExternalReference'] ?? null;
        $resultCode = $callback['ResultCode'] ?? null;
        $resultDesc = $callback['ResultDesc'] ?? '';
        $fullJson = json_encode($payload);

        $transaction = Transaction::where('transaction_reference', $externalRef)->first();
        if (!$transaction) {
            Log::warning("Transaction not found for ref: $externalRef");
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // update status and description
        $transaction->transaction_status = $resultCode == 0 ? 'successful' : 'failed';
        $transaction->transaction_description = $resultDesc . ' | ' . $fullJson;
        $transaction->save();

        // if successful, create and activate subscription
        if ($resultCode == 0) {
            $package = Packages::find($transaction->package_id);
            if ($package) {
                Subscription::create([
                    'user_id' => $transaction->user_id,
                    'package_id' => $package->id,
                    'start_date' => now()->format('Y-m-d'),
                    'end_date' => now()->addDays($package->period)->format('Y-m-d'),
                    'status' => 'active',
                    'transaction_id' => $transaction->id,
                ]);
            }
        }
        Log::info("Transaction $externalRef processed");

        return response()->json(['message' => 'Processed'], 200);
    } catch (Throwable $e) {
        Log::error('TinyPesa response error: ' . $e->getMessage());
        return response()->json(['message' => 'Error occurred'], 500);
    }
})->name('tinyPesa.response');

