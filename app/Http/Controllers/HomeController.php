<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $tips = Tips::orderBy('match_start_time','desc')->paginate(5);
        $tips->map(function ($tip){
            $tip = $this->mapImage($tip);
            return $tip;
        });


        $latest_tip = $tips[0];

        $latest_tip = $this->mapImage($latest_tip);

        return Inertia::render('Welcome',[
            'tips' =>  $tips,
            'upcoming' => $latest_tip
        ]);
    }

    private function mapImage(mixed $latest_tip)
    {
        $hometeam_logo = DB::select('select * from clubs where name = ?',[$latest_tip->home_teams])[0]->logo;
        $awayTeam_logo = DB::select('select * from clubs where name = ?',[$latest_tip->away_teams])[0]->logo;


        $latest_tip->home_logo = $hometeam_logo;
        $latest_tip->away_logo = $awayTeam_logo;

        return $latest_tip;
    }
}
