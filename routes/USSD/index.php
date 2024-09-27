<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::prefix('USSD')->group(function (){
    Route::get('/', function (Request $request){
        return "Thank you for using our service END";
    });
});
