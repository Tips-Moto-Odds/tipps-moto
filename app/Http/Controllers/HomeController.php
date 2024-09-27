<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PHPMailer\PHPMailer\PHPMailer;

class HomeController extends Controller
{
    public function index()
    {
        $tips = Tips::orderBy('match_start_time', 'desc')->limit(3)->get();
        $latest_tip = null;

        if (count($tips) > 0) {
            $tips->map(function ($tip) {
                $tip = $this->mapImage($tip);
                return $tip;
            });

            $latest_tip = $tips[0];

            $latest_tip = $this->mapImage($latest_tip);
        }

        return Inertia::render('Welcome', [
            'tips' => $tips,
            'upcoming' => $latest_tip
        ]);
    }

    private function mapImage(mixed $latest_tip)
    {

        $hometeam_logo = DB::select('select * from clubs where name = ?', [$latest_tip->home_teams]) ??
            DB::select('select * from clubs where name = ?', [$latest_tip->home_teams])[0]->logo;
        $awayTeam_logo = DB::select('select * from clubs where name = ?', [$latest_tip->away_teams]) ??
            DB::select('select * from clubs where name = ?', [$latest_tip->away_teams])[0]->logo;

        if (!$hometeam_logo || !$awayTeam_logo) {
            $hometeam_logo = 'icons8-ball-100.png';
            $awayTeam_logo = 'icons8-ball-100.png';
        }

        $latest_tip->home_logo = $hometeam_logo;
        $latest_tip->away_logo = $awayTeam_logo;

        return $latest_tip;
    }
}
