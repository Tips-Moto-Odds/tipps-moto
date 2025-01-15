<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return Inertia::render('UserPanel/index',[
            'user' => $user,
        ]);
    }

    public function subscriptions(){
        return Inertia::render('UserPanel/Subscriptions');
    }

}
