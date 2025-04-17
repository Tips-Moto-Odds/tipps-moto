<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\Jobs\SendPushNotifications;
    use Illuminate\Support\Facades\Route;
    use App\Http\Middleware\LogInAsAdmin;
    use App\Http\Middleware\CaptureAffiliateLink;


    Route::middleware([
                          CaptureAffiliateLink::class,
                          LogInAsAdmin::class
                      ])->group(function () {
        include_once "OpenRoutes/index.php";
        include_once "GuestRoutes/index.php";
        include_once "AuthRoutes/index.php";
    });

    Route::post('/notifications/subscribe', function (Request $request) {
        $data = $request->all();

        DB::table('browser_push_subscriptions')->updateOrInsert(
            ['endpoint' => $data['endpoint']],
            [
                'user_id'    => auth()->id(),
                'p256dh'     => $data['keys']['p256dh'],
                'auth'       => $data['keys']['auth'],
                'updated_at' => now()
            ]
        );

        return response()->json(['status' => 'ok']);
    });

    Route::post('/notifications/notify', function (Request $request) {
        $title = $request->input('title', 'TipsMoto');
        $body = $request->input('body', 'Welcome to Tips Moto!');

        SendPushNotifications::dispatch($title, $body);

        return response()->json(['status' => 'queued']);
    });



