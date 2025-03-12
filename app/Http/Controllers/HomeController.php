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


        $yesterdaysMatches = function () {
            $yesterdayStart = Carbon::yesterday()->startOfDay()->toDateTimeString();
            $yesterdayEnd = Carbon::yesterday()->endOfDay()->toDateTimeString();

            return Matches::with('tips')
                ->whereBetween('match_start_time', [$yesterdayStart, $yesterdayEnd])
                ->inRandomOrder()
                ->get()
                ->sortBy('match_start_time')
                ->flatMap(fn($match) =>
                $match->tips->map(fn($tip) => [
                    'match_start_time' => $match->match_start_time,
                    'home_teams' => $match->home_teams,
                    'away_teams' => $match->away_teams,
                    'prediction_type' => $tip->prediction_type,
                    'predictions' => $tip->predictions,
                ])
                )->random(15)
                ;
        };

        $canViewFreeTips = function () {
            if (Auth::check()) {
                $today = Carbon::today();

                $userCreatedAt = optional(Auth::user())->created_at;

                $lastSubscriptionDate = optional(Auth::user()->subscriptions()->orderBy('end_date', 'desc')->first())->end_date;

                $lastSubscriptionDate = $lastSubscriptionDate ? Carbon::parse($lastSubscriptionDate) : null;

                $daysSinceCreation = $userCreatedAt ? $userCreatedAt->diffInDays($today) : null;
                $daysSinceLastSubscription = $lastSubscriptionDate?->diffInDays($today);


                return (Auth::check() && Auth::user()->subscriptions()->where('status', 'active')->where('end_date', '>', now()->toDateString())->exists())
                    || (Auth::check() && $daysSinceCreation <= 3)
                    || (Auth::check() && $daysSinceLastSubscription <= 3);
            } else {
                return true;
            }
        };

        return Inertia::render('Welcome', [
            'tips' => $tipsQuery,
            'yesterdaysTips' => $yesterdaysMatches(),
            'canViewFreeTips' => $canViewFreeTips
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
