<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MarketingController extends Controller
{
    public function index(Request $request, $page = 'premier_league')
    {
        $league = 'premier_league';
        switch ($page) {
            case 'premier_league':
                $league = 'PREMIER LEAGUE';
                break;
            case 'bundesliga':
                $league = 'Bundesliga';
                break;
            case 'series_a':
                $league = 'SERIES A';
                break;
            case 'league_1':
                $league = 'LEAGUE 1';
                break;
            case 'la_liga':
                $league = 'LA LIGA';
                break;
        }
        return Inertia::render('Marketing/ListDesign', [
                'league' => $league,
                'events' => $this->data_resource($page),
            ]
        );
    }

    public function data_resource($page)
    {
        return match ($page) {
            'premier_league' => [
                [
                    "home" => "https://apiv3.apifootball.com/badges/3072_southampton.jpg",
                    "away" => "https://apiv3.apifootball.com/badges/102_manchester-united.jpg",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "0",
                    "away_score" => "3",
                ],
                [
                    "home" => "https://apiv3.apifootball.com/badges/80_manchester-city.jpg",
                    "away" => "https://apiv3.apifootball.com/badges/3086_brentford.jpg",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "2",
                    "away_score" => "1",
                ],
                [
                    "home" => "https://apiv3.apifootball.com/badges/3071_afc-bournemouth.jpg",
                    "away" => "https://apiv3.apifootball.com/badges/88_chelsea.jpg",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "0",
                    "away_score" => "1",
                ],
                [
                    "home" => "https://apiv3.apifootball.com/badges/164_tottenham-hotspur.jpg",
                    "away" => "https://apiv3.apifootball.com/badges/141_arsenal.jpg",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "0",
                    "away_score" => "1",
                ],
                [
                    "home" => "https://apiv3.apifootball.com/badges/3077_wolverhampton-wanderers.jpg",
                    "away" => "https://apiv3.apifootball.com/badges/3100_newcastle-united.jpg",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "1",
                    "away_score" => "2",
                ],
            ],
            'bundesliga' => [
                [
                    "home" => "https://media.api-sports.io/football/teams/170.png",
                    "away" => "https://media.api-sports.io/football/teams/186.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "3",
                    "away_score" => "1",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/167.png",
                    "away" => "https://media.api-sports.io/football/teams/168.png",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "1",
                    "away_score" => "4",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/163.png",
                    "away" => "https://media.api-sports.io/football/teams/172.png",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "1",
                    "away_score" => "3",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/191.png",
                    "away" => "https://media.api-sports.io/football/teams/1860.png",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "1",
                    "away_score" => "6",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/165.png",
                    "away" => "https://media.api-sports.io/football/teams/180.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "4",
                    "away_score" => "2",
                ],
            ],
            'series_a' => [
                [
                    "home" => "https://media.api-sports.io/football/teams/487.png",
                    "away" => "https://media.api-sports.io/football/teams/24733.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "2",
                    "away_score" => "1",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/499.png",
                    "away" => "https://media.api-sports.io/football/teams/502.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "3",
                    "away_score" => "2",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/490.png",
                    "away" => "https://media.api-sports.io/football/teams/492.png",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "0",
                    "away_score" => "4",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/489.png",
                    "away" => "https://media.api-sports.io/football/teams/15685.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "4",
                    "away_score" => "0",
                ],
            ],
            'league_1' => [
                [
                    "home" => "https://media.api-sports.io/football/teams/85.png",
                    "away" => "https://media.api-sports.io/football/teams/106.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "3",
                    "away_score" => "1",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/7936.png",
                    "away" => "https://media.api-sports.io/football/teams/82.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "3",
                    "away_score" => "0",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/96.png",
                    "away" => "https://media.api-sports.io/football/teams/111.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "2",
                    "away_score" => "0",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/81.png",
                    "away" => "https://media.api-sports.io/football/teams/84.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "2",
                    "away_score" => "0",
                ],
                [
                    "home" => "https://media.api-sports.io/football/teams/108.png",
                    "away" => "https://media.api-sports.io/football/teams/91.png",
                    "prediction" => "2",
                    "status" => "won",
                    "home_score" => "0",
                    "away_score" => "3",
                ],
            ],
            'la_liga' => [
                [
                    "home" => "https://media.api-sports.io/football/teams/85.png",
                    "away" => "https://media.api-sports.io/football/teams/106.png",
                    "prediction" => "1",
                    "status" => "won",
                    "home_score" => "3",
                    "away_score" => "1",
                ],
            ],
            default => [],
        };

    }
}
