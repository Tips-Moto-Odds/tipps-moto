<?php

use App\Jobs\SendPushNotifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/get-subscriptions', function () {
    return DB::table('browser_push_subscriptions')->get(['endpoint', 'p256dh', 'auth']);
});


Route::post('/remove-subscription', function (Request $request) {
    $endpoint = $request->input('endpoint');

    DB::table('browser_push_subscriptions')->where('endpoint', $endpoint)->delete();

    return response()->json(['status' => 'deleted']);
});

Route::post('/notifications/subscribe', function (Request $request) {
    $data = $request->all();

    DB::table('browser_push_subscriptions')->updateOrInsert(
        [
            'endpoint' => $data['endpoint']
        ],
        [
            'user_id' => auth()->id(),
            'p256dh' => $data['keys']['p256dh'],
            'auth' => $data['keys']['auth'],
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
