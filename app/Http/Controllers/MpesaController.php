<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Telemetry\Info;

class MpesaController extends Controller
{
    private $access_token = null;

    public function initiateTransaction(Request $request)
    {
        $initiator = $request->input('user_number');

        $this->set_access_token();
        dd($this->make_payment_request());
    }

    public function set_access_token(): void
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic SUpnZ0p0MmQwRjkxNm5mWXFsclJFQTFhSlR5eUozOTE4NXh3dG5nUE5wWjZGMkFiOk9JeVEwaFk3UkpnVnJGU3huZlJSUWZXVlBkMjJqbUdpa2l1RlFFWndxSzhzSmk5Mk5oVldpYTl1ejYxNk1QZlg=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response);

        $this->access_token = $data->access_token;
    }

    public function make_payment_request(): bool|string
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "BusinessShortCode": "174379",
                                        "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3",
                                        "Timestamp": "20160216165627",
                                        "TransactionType": "CustomerPayBillOnline",
                                        "Amount": "10",
                                        "PartyA": "254708374149",
                                        "PartyB": "174379",
                                        "PhoneNumber": "254708374149",
                                        "CallBackURL": "https://tipsmoto.co.ke/mpesaCallback",
                                        "AccountReference": "Test",
                                        "TransactionDesc": "Test"
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$this->access_token,
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function mpesaCallback(Request $request){
        Log::info($request);
    }
}
