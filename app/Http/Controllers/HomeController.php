<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Tips;
use App\Service\BusinessPolicyService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    protected BusinessPolicyService $businessPolicyService;

    public function __construct(BusinessPolicyService $businessPolicyService)
    {
        $this->businessPolicyService = $businessPolicyService;
    }

    public function home(): Response
    {

        $tipsQuery = Tips::getFreeUpcomingTips();

        $yesterdaysMatches = Matches::getYesterdaysMatchesWithTips();

        $user = Auth::user();

//        $canViewFreeTips = $user instanceof User && $this->businessPolicyService->canViewFreeTips($user);

        return Inertia::render('Welcome', [
            'tips' => $tipsQuery,
            'yesterdaysTips' => $yesterdaysMatches,
            'canViewFreeTips' => true
        ]);
    }

    public function about(): Response
    {
        return Inertia::render('Home/SiteMap/About');
    }

    public function faq(): Response
    {
        return Inertia::render('Home/SiteMap/FrequentlyAskedQuestions');
    }

    public function privacyPolicy(): Response
    {
        return Inertia::render('Home/SiteMap/PrivacyPolicy');
    }

    public function termsOfService(): Response
    {
        return Inertia::render('Home/SiteMap/TermsOfService');
    }
}
