<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

include_once "OpenRoutes/index.php";
include_once "GuestRoutes/index.php";
include_once "AdminRoutes/index.php";

//Route::get('/login', function () {
//    return Inertia::render('Home/SignUp');
//});

Route::get('/mail',[MailController::class,'mail']);
Route::get('/marketing/{page?}',[MarketingController::class,'index']);
