<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Inertia\Inertia;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class HomeController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('Welcome', [
            'tips' => Tips::orderBy('match_start_time', 'desc')->limit(3)->get(),
            'upcoming' => Tips::orderBy('match_start_time', 'desc')->first(),
        ]);
    }

    public function tips(): Response
    {
        return Inertia::render('tips');
    }

    public function about(): Response
    {
        return Inertia::render('Home/About');
    }

    public function contactUs(): Response
    {
        return Inertia::render('Home/ContactUs');
    }

    public function packages(): Response
    {
        return Inertia::render('Home/Packages', [
            'packages' => Packages::all()
        ]);
    }

    public function subscribeView(Request $request, $sub): Response
    {
        $package = Packages::find($sub);

        return Inertia::render('Home/Subscribe', [
            'package'          => $package,
            'is_authenticated' => Auth::check()
        ]);
    }

    public function termsOfService(): Response{
        return Inertia::render('Home/TermsOfService');
    }

    public function privacyPolicy(): Response
    {
        return Inertia::render('Home/PrivacyPolicy');
    }

}
