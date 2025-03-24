<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Log;
use JsonException;
use RuntimeException;

class OnitController extends Controller
{
    /**
     * @throws JsonException
     */
    public function authorize(): bool
    {
        $fields = [
            'userId' => env('ONIT_USER_ID'),
            'password' => env('ONIT_KEY')
        ];

        $fields_string = json_encode($fields, JSON_THROW_ON_ERROR);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ONIT_END_POINT') . '/api/v1/auth/jwt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $fields_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        try {
            $response = curl_exec($curl);

            $response = json_decode($response, false, 512, JSON_THROW_ON_ERROR);

            $_ENV['ONIT_API_KEY'] = $response->access_token;

            return true;
        } catch (Exception $e) {
            LOG::info($e->getMessage());
            return false;
        } finally {
            curl_close($curl);
        }
    }

    /**
     * @throws Exception
     */
    public function deposit($req)
    {
        $auth = $this->authorize();

        if (!$auth) {
            throw new RuntimeException('Payment Authorization Error');
        }

        $package = Packages::where('name', $req['package'])->first();

        //TODO::reset price

        $body = [
            "originatorRequestId" => $req['transaction_code'],
            "destinationAccount" => "0001401000165",
            "sourceAccount" => $req['phone'],
            "amount" => $package->price + $package->tax,
            "channel" => "MPESA",
            "product" => env("ONIT_PRODUCT_NAME"),
            "narration" => "Purchasing " . $req['package_name'] . 'Package',
            "callbackUrl" => "https://tipsmoto.co.ke/api/onit/deposit/response"
        ];

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $_ENV['ONIT_API_KEY'],
        ];
        $body_string = json_encode($body, JSON_THROW_ON_ERROR);

        $request = new Request('POST', env('ONIT_END_POINT') . '/api/v1/transaction/deposit', $headers, $body_string);

        $res = $client->sendAsync($request)->wait();
        return json_decode($res->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
    }

    public function confirmPayment(HttpRequest $request): void
    {
        Log::info($request);
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
            Log::warning('Transaction: ' . $request->all());
        }
    }
}


