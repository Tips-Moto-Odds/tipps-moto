<?php


use App\Http\Middleware\CaptureAffiliateLink;
use App\Http\Middleware\LogInAsAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware([
    CaptureAffiliateLink::class,
    LogInAsAdmin::class
])->group(function () {
    include_once "OpenRoutes/index.php";
    include_once "GuestRoutes/index.php";
    include_once "AuthRoutes/index.php";
});

