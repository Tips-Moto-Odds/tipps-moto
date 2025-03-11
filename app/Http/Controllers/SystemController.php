<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SystemController extends Controller
{

    public function index()
    {
        return Inertia::render('Dashboards/Administrator/System/Index');
    }

    public function syncData(Request $request)
    {
        dd($request);
    }
}
