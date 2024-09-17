<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MarketingController extends Controller
{
    public function index(Request $request, $page = 'premier_league')
    {
        return Inertia::render('Marketing/ListDesign', [
                'events' => $this->data_resource($page)
            ]
        );
    }

    public function data_resource($page)
    {
        switch ($page) {
            case 'premier_league':
                return [
                    [
                        "home" => "https://apiv3.apifootball.com/badges/3072_southampton.jpg",
                        "away" => "https://apiv3.apifootball.com/badges/102_manchester-united.jpg",
                        "prediction" => "2",
                        "status" => "completed",
                        "home_score" => "0",
                        "away_score" => "3",
                    ],
                    [
                        "home" => "https://apiv3.apifootball.com/badges/80_manchester-city.jpg",
                        "away" => "https://apiv3.apifootball.com/badges/3086_brentford.jpg",
                        "prediction" => "1",
                        "status" => "completed",
                        "home_score" => "2",
                        "away_score" => "1",
                    ],
                    [
                        "home" => "https://apiv3.apifootball.com/badges/3071_afc-bournemouth.jpg",
                        "away" => "https://apiv3.apifootball.com/badges/88_chelsea.jpg",
                        "prediction" => "2",
                        "status" => "completed",
                        "home_score" => "0",
                        "away_score" => "1",
                    ],
                    [
                        "home" => "https://apiv3.apifootball.com/badges/164_tottenham-hotspur.jpg",
                        "away" => "https://apiv3.apifootball.com/badges/141_arsenal.jpg",
                        "prediction" => "2",
                        "status" => "completed",
                        "home_score" => "0",
                        "away_score" => "1",
                    ],
                    [
                        "home" => "https://apiv3.apifootball.com/badges/3077_wolverhampton-wanderers.jpg",
                        "away" => "https://apiv3.apifootball.com/badges/3100_newcastle-united.jpg",
                        "prediction" => "2",
                        "status" => "completed",
                        "home_score" => "1",
                        "away_score" => "2",
                    ],
                ];
                break;
        }

        return [];
    }
}
