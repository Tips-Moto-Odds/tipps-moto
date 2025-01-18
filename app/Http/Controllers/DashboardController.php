<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role->name === 'SuperAdministration') {
            return Inertia::render('AdminDashboard');
        }

        return Inertia::render('UserPanel/index', ['user' => $user,]);
    }

    public function subscriptions()
    {
        $user = Auth::user();
        return Inertia::render('UserPanel/Subscriptions', ['subscriptions' => $user->subscriptions]);
    }

}
