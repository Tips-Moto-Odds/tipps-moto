<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller implements HasMiddleware
{
    public function index(Request $request)
    {
        $users = User::all();
        return Inertia::render('Dashboard', [
            'users' => [
                'users' => $users,
                'increase_percentage' => 10,
                ],
            'payments' => [
                'payments' => 0,
                'increase_percentage' => 0
            ],
            'model' => [
                'model' => 0,
                'increase_percentage'
            ]
        ]);
    }

    public static function middleware()
    {
        return [
            UserMiddleware::class
        ];
    }
}
