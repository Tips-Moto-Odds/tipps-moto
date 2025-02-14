<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Role;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MatchesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $dateFilter = $request->query('date'); // "today"
        $from = $request->query('from'); // Start time filter
        $to = $request->query('to'); // End time filter
        $played = $request->query('played'); // "true" if filtering played matches

        // Start query
        $matches = Matches::withCount('tips');


        // Apply search filter
        if ($search) {
            $matches->where(function ($q) use ($search) {
                $q->where('league', 'like', "%{$search}%")
                    ->orWhere('home_teams', 'like', "%{$search}%")
                    ->orWhere('away_teams', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('match_start_time', 'like', "%{$search}%");
            });
        }

        // Filter matches for today
        if ($dateFilter) {
            $matches->whereDate('match_start_time', today());
        }

        // Filter by custom time range
        if ($from && $to) {
            Debugbar::info([
                'from' => $from,
                'to' => $to,
            ]);
            $matches->whereBetween('match_start_time', [$from, $to]);
        }

        // Filter played matches (more than 2 hours past match start time)
        if ($played === 'true') {
            $matches->where('match_start_time', '<=', now()->subHours(2));
        }

        $matches = $matches->orderBy('match_start_time', 'desc')->paginate(10)->appends($request->query());

        return Inertia::render('Dashboards/Administrator/Matches/Index', [
            'matches' => $matches,
            'search' => $search,
            'filters' => [
                'date' => $dateFilter,
                'from' => $from,
                'to' => $to,
                'played' => $played,
            ],
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Dashboards/Administrator/Matches/create');
    }

    public function update(Request $request, Matches $match)
    {
        return Inertia::render('Dashboards/Administrator/Matches/update', [
            'match' => $match,
        ]);
    }

    public function post(Request $request)
    {
        $validated = $request->validate([
            'league' => 'required|string|max:255',
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'match_start_time' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $match = new Matches();
        $match->league = $validated['league'];
        $match->home_teams = $validated['home_team'];
        $match->away_teams = $validated['away_team'];
        $match->match_start_time = $validated['match_start_time'];
        $match->status = 'pending';
        $match->save();

        return redirect()->route('dashboard.matches.viewMatch', [
            'match' => $match->id
        ])
            ->with('message', 'Match created successfully.');
    }

    public function patch(Request $request, Matches $match)
    {
        $validated = $request->validate([
            'league' => 'required|string|max:255',
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'match_start_time' => 'required',
            'mark_as_free' => 'required|boolean',
        ]);

        $match->league = $validated['league'];
        $match->home_teams = $validated['home_team'];
        $match->away_teams = $validated['away_team'];
        $match->match_start_time = $validated['match_start_time'];
        $match->status = 'pending';
        $match->mark_as_free = $validated['mark_as_free'];
        $match->save();

        return redirect()->route('dashboard.matches.viewMatch', [$match->id]);
    }

    public function view(Request $request, Matches $match)
    {
        $match = $match->load('tips');
        return Inertia::render('Dashboards/Administrator/Matches/view', [
            'match' => $match
        ]);
    }

    public function delete(Request $request, Matches $match)
    {
        $match->delete();
        return [
            'suceess' => true,
        ];
    }
}
