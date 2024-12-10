<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Inertia\Inertia;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(): \Inertia\Response
    {
        return Inertia::render('Welcome', [
            'tips' => Tips::orderBy('match_start_time', 'desc')->limit(3)->get(),
            'upcoming' => Tips::orderBy('match_start_time', 'desc')->first(),
        ]);
    }

    public function tips(): \Inertia\Response
    {
        return Inertia::render('tips');
    }

    public function about(): \Inertia\Response
    {
        return Inertia::render('Home/About');
    }

    public function contactUs(): \Inertia\Response
    {
        return Inertia::render('Home/ContactUs');
    }

    public function packages(): \Inertia\Response
    {
        return Inertia::render('Home/Packages', [
            'packages' => Packages::all()
        ]);
    }

    public function subscribeView(Request $request, $sub): \Inertia\Response
    {
        $package = Packages::find($sub);

        return Inertia::render('Home/Subscribe', [
            'package'          => $package,
            'is_authenticated' => Auth::check()
        ]);
    }

    public function termsOfService(): \Inertia\Response{
        return Inertia::render('Home/TermsOfService');
    }

    public function privacyPolicy(): \Inertia\Response
    {
        return Inertia::render('Home/PrivacyPolicy');
    }

}
