<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function Laravel\Prompts\select;

class TipsController extends Controller
{
    private string $folder = 'Administration/Manage/';

    public function index(Request $request)
    {
        $tips = Tips::orderBy('match_start_time', 'desc')->paginate(10);

        return Inertia::render($this->folder.'Tips/Index',[
            'tips' => $tips
        ]);
    }

    public function view(Request $request,Tips $tip)
    {

        $home_team_image = DB::select('select * from clubs where name=?',[$tip->home_teams])[0]->logo;
        $away_team_image = DB::select('select * from clubs where name=?',[$tip->away_teams])[0]->logo;

        $tip->home_team_image = $home_team_image;
        $tip->away_team_image = $away_team_image;

        return Inertia::render($this->folder.'Tips/view',[
            'tip' => $tip
        ]);
    }
}
