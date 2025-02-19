<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class HomeController extends Controller
{
    public function home(Request $request): Response
    {
        //TODO: Note check this because it generates new free tips over and over
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

    public function tips(): Response
    {
        $packages = Packages::all();
        return Inertia::render('tips',[
            'packages' => $packages
        ]);
    }

    public function about(): Response
    {
        return Inertia::render('Home/About');
    }

    public function faq(): Response
    {
        return Inertia::render('Home/FrequentlyAskedQuestions');
    }

    public function privacyPolicy(): Response
    {
        return Inertia::render('Home/PrivacyPolicy');
    }

    public function termsOfService(): Response
    {
        return Inertia::render('Home/TermsOfService');
    }



}
