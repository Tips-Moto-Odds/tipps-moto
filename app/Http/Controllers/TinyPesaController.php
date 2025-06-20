<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TinyPesaController extends Controller
{
    public function deposit($req)
    {
        $package = Packages::where('name', $req['package'])->first();
        if (!$package) {
            Log::error("Package not found: " . $req['package']);
            return response()->json(['error' => 'Package not found'], 404);
        }

        $amount = $package->price + $package->tax;
        $msisdn = $req['phone'];
        $accountNo = 'tips-moto-001';
        $username = 'TipsMoto';

        $client = new Client();

        try {
            $response = $client->post(
                'https://api.tinypesa.com/api/v1/express/initialize/?username=TipsMoto',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Apikey' => env('TINYPESA_API_KEY'),
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode([
                        'amount' => $amount,
                        'msisdn' => $msisdn,
                        'account_no' => $accountNo,
                        'username' => $username,
                    ]),
                    'verify' => false // for development only
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            Log::error('TinyPesa Error: ' . $e->getMessage());
            return response()->json(['error' => 'TinyPesa API request failed'], 500);
        }
    }

    public function confirmPayment(Request $request): void
    {
        Log::info($request->all());

        $process = false;

        if ($process && $request->has('originatorRequestId')) {
            $transaction_string = $request->input('originatorRequestId');
            $parts = explode('|', $transaction_string);
            $code = $parts[1] ?? null;

            if ($code) {
                $transaction = Transaction::where('transaction_reference', $code)->first();

                if ($transaction) {
                    $transaction->transaction_status = 'successful';

                    $package = Packages::find($transaction->package_id);
                    $endDate = now()->addDays($package->period);

                    Subscription::create([
                        'user_id' => $transaction->user_id,
                        'package_id' => $package->id,
                        'start_date' => now()->format('Y-m-d'),
                        'end_date' => $endDate->format('Y-m-d'),
                        'status' => 'active',
                        'transaction_id' => $transaction->id,
                    ]);

                    $transaction->save();
                } else {
                    Log::info("Transaction not found for code: $code");
                }
            } else {
                Log::warning("Invalid originatorRequestId: $transaction_string");
            }
        }
    }
}
