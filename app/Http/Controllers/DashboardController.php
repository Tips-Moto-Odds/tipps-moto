<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
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
}
