<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::post('/subscribe',[SubscriptionController::class,'subscribe'])->name('subscribe');


//function ()
//{
//    $curl = curl_init();
//
//    curl_setopt_array($curl, array(
//        CURLOPT_URL => 'http://41.206.52.138:30851/api/v1/auth/jwt',
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => '',
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 0,
//        CURLOPT_FOLLOWLOCATION => true,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => 'POST',
//        CURLOPT_POSTFIELDS => '{
//"userId" : 2350,
//"password" : "ONIT-07"
//}',
//        CURLOPT_HTTPHEADER => array(
//            'Content-Type: application/json'
//        ),
//    ));
//    $response = curl_exec($curl);
//    curl_close($curl);
//
//
//    $token_pack = json_decode($response);
//    $access_token = $token_pack->access_token;
//
//
//    $curl = curl_init();
//
//    curl_setopt_array($curl, array(
//        CURLOPT_URL => 'http://41.206.52.138:30851/api/v1/transaction/deposit',
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => '',
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 0,
//        CURLOPT_FOLLOWLOCATION => true,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => 'POST',
//        CURLOPT_POSTFIELDS => '{
//          "originatorRequestId": "0020001-AD",
//          "destinationAccount": "0001401000164",
//          "sourceAccount": "254700293854",
//          "amount": 2,
//          "channel": "MPESA",
//          "product": "ST01",
//          "narration": "Test1 1",
//          "callbackUrl": "https://tipsmoto.co.ke/api/onit/deposit/response"
//        }',
//        CURLOPT_HTTPHEADER => array(
//            'Content-Type: application/json',
//            'Authorization: Bearer '.$access_token
//        ),
//    ));
//
////    $response = curl_exec($curl);
//
//    curl_close($curl);
//    dd($response);
//}

