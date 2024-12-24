<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard.profile.ManagerProfile');
        return Inertia::render('Dashboard');
    }

}
