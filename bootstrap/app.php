<?php

use App\Http\Middleware\DisableAccess;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\UpcomingMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            UpcomingMiddleware::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            DisableAccess::class
        ]);

        $middleware->api(append: [
            EnsureFrontendRequestsAreStateful::class
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })
    ->create();
