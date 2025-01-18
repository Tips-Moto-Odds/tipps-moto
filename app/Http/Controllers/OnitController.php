<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Barryvdh\Debugbar\Facades\Debugbar;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class OnitController extends Controller
{
    public function authorize()
    {
        $fields = [
            'userId' => env('ONIT_USER_ID'),
            'password' => env('ONIT_KEY')
        ];

        $fields_string = json_encode($fields);

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

            $response = json_decode($response);

            $_ENV['ONIT_API_KEY'] = $response->access_token;

            return true;
        } catch (\Exception $e) {
            LOG::info($e->getMessage());
        } finally {
            curl_close($curl);
        }
    }

    /**
     * @throws \Exception
     */
    public function deposit($req)
    {
        $auth = $this->authorize();

        if (!$auth) {
            throw new \RuntimeException('Payment Authorization Error');
        }

        $price = Packages::where('name',$req['package'])->first();
        $price = number_format($price->price * 1.16, 2);

        //TODO::reset price

        $body = [
            "originatorRequestId" => $req['transaction_code'],
            "destinationAccount" => "0001401000165",
            "sourceAccount" => $req['phone'],
            "amount" => $price + ($price * 0.015),
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
        return json_decode($res->getBody()->getContents(), false);
    }
}


