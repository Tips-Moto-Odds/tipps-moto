<?php

namespace App\Http\Controllers;

use App\Models\Matches;
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
        $tipsQuery = Tips::join('matches as m', 'tips.match_id', '=', 'm.id')
            ->whereNull('m.deleted_at')
            ->where('tips.mark_as_free', 1)
            ->where('m.match_start_time', '>=', Carbon::now())
            ->select('tips.id as tip_id', 'm.id as match_id', 'm.league', 'm.home_teams',
                'm.away_teams', 'm.match_start_time', 'tips.mark_as_free',
                'tips.prediction_type', 'tips.predictions')
            ->orderBy('m.match_start_time', 'asc')
            ->limit(3)
            ->get();


        $yesterdayStart = Carbon::yesterday()->startOfDay()->toDateTimeString();
        $yesterdayEnd = Carbon::yesterday()->endOfDay()->toDateTimeString();
        $yesterdaysMatches = [];

        $tips = Tips::join('matches as m','tips.match_id','=','m.id')
            ->whereBetween('m.match_start_time', [$yesterdayStart, $yesterdayEnd])
            ->where(function ($query){
                $query->where('tips.status','Won')
                    ->orWhere('tips.status','Lost')
                ;
            })
            ->toSql() ?? [];

//        if ($matches) {
//            $yesterdaysMatches = $matches->map(function ($match) {
//                return $match;
//            });
//        }


        return Inertia::render('Welcome', [
            'tips' => $tipsQuery,
            'yesterdaysTips' => $yesterdaysMatches
        ]);
    }

    public function tips(): Response
    {
        $packages = Packages::all();
        return Inertia::render('tips', [
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
