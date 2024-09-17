<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MarketingController extends Controller
{
    public function index(Request $request, $page = 1)
    {
        return Inertia::render('Marketing/ListDesign');
    }
}
