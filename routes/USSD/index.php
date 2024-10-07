<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::prefix('/USSD')->group(function () {

    Route::post('/Callback', function (Request $request) {
        $session_id = $request->input("session_id");
        $service_code = $request->input("service_code");
        $phone_number = $request->input("phone_number");
        $text = $request->input("text");
        $responseText = "Invalid Entry";

        if ($text == ""){
            $responseText = "CON 5 Million up for grabs!!! \n
            1. LUCKY BOX(KES 20) \n
            2. LUCKY BOX(2) \n
            ";
        }else if ($text == "1"){
            $responseText = "CON Choose your lucky box \n
            1. Box 1 \n
            2. Box 2 \n
            3. Box 3 \n
            4. Box 4 \n
            5. Box 5 \n
            0. End \n
            ";
        }else if ($text == "1*1" || $text == "1*2" || $text == "1*3" || $text == "1*4" || $text == "1*5"){
//            explode the text with * as the delimeter and get the last digit
            $box_number = substr($text, -1);

            $responseText = "CON You chose $box_number \n
            1. Box 1 Ksh 0 \n
            2. Box 2 Ksh 5,000 \n
            3. Box 3 Ksh 10,000 \n
            4. Box 4 Ksh 10\n
            5. Box 5 Ksh 3,000\n
            0. End \n
            ";

        }else{
            Log::info('USSD Callback: '. json_encode($request->all()));
            $responseText = "END Invalid Entry";
        }



        return response($responseText)
            ->header('Content-Type', 'text/plain');
    });
});

