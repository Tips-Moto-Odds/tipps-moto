<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PackagesController extends Controller
{
    public function index()
    {
        $packages = Packages::all();

        return Inertia::render('Home/Packages', [
            'packages' => $packages
        ]);
    }

    public function subscribe_view(Request $request, $sub)
    {
        $package = Packages::find($sub);

        return Inertia::render('Home/Subscribe', [
            'package' => $package,
            'is_authenticated' => Auth::check()
        ]);
    }
}
