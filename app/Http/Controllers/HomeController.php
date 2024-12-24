<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request): \Inertia\Response
    {
        $tipsQuery = DB::select('
        SELECT
              t.id AS tip_id,
              m.id AS match_id,
              m.league,
              m.home_teams,
              m.away_teams,
              m.match_start_time,
              t.mark_as_free,
              t.prediction_type,
              t.predictions
          FROM tips AS t
                   INNER JOIN matches AS m ON t.match_id = m.id
          WHERE m.deleted_at IS NULL
            AND t.mark_as_free = 1
            AND m.match_start_time >= NOW()
                  ORDER BY m.match_start_time ASC
                  LIMIT 3');


        return Inertia::render('Welcome', [
            'tips' => $tipsQuery,
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
            'package' => $package,
            'is_authenticated' => Auth::check()
        ]);
    }

    public function termsOfService(): \Inertia\Response
    {
        return Inertia::render('Home/TermsOfService');
    }

    public function privacyPolicy(): \Inertia\Response
    {
        return Inertia::render('Home/PrivacyPolicy');
    }

}
