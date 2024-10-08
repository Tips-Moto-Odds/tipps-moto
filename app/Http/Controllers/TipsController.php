<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function Laravel\Prompts\select;

class TipsController extends Controller
{

    private string $folder = 'Administration/';

    public function index(Request $request)
    {
        $tips = null;
        $user_data = [];

        switch (Auth::user()->role->name) {
            case 'Administrator':
            case 'Moderator':
                $tips = Tips::orderBy('match_start_time', 'desc')->paginate(10);
                return Inertia::render('Dashboards/Administrator/Tips/Index', [
                    'tips' => $tips,
                    'user_data' => $user_data
                ]);
            case 'Customer':
            case 'Guest':
                //find the users subscriptions
                $user_data['subscriptions_details'] = Auth::user()->active_subscription;

                if (Auth::user()->active_subscription) {
                    $tips = Tips::orderBy('match_start_time', 'desc')->paginate(10);
                }

                return Inertia::render("Dashboards/User/Tips/Index", [
                    'tips' => $tips,
                    'user_data' => $user_data
                ]);
            default:
                return redirect()->back();

        }

        return Inertia::render($this->folder . 'Tips/Index', [
            'tips' => $tips,
            'user_data' => $user_data
        ]);
    }

    public function view(Request $request, Tips $tip)
    {

        $home_team_image = DB::select('select * from clubs where name=?', [$tip->home_teams])[0]->logo;
        $away_team_image = DB::select('select * from clubs where name=?', [$tip->away_teams])[0]->logo;

        $tip->home_team_image = $home_team_image;
        $tip->away_team_image = $away_team_image;

        return Inertia::render("Dashboards/User/Tips/view", [
            'tip' => $tip
        ]);
    }
}
