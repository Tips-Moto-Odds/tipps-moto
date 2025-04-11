<?php

    namespace App\Http\Controllers;

    use Inertia\Inertia;
    use App\Models\Matches;
    use Illuminate\Http\Request;

    class MatchesController extends Controller {
        public function index(Request $request)
        {
            $filters = $request->only(['search', 'simpleFilter', 'date', 'from', 'to', 'played']);

            $search = $filters['search'] ?? null;
            $simpleFilter = $filters['simpleFilter'] ?? null;
            $dateFilter = $filters['date'] ?? null;
            $from = $filters['from'] ?? null;
            $to = $filters['to'] ?? null;
            $played = $filters['played'] ?? null;

            $matches = Matches::withCount('tips')
                              ->when($search, function ($query, $search) {
                                  $query->where(function ($q) use ($search) {
                                      $q
                                          ->where('league', 'like', "%{$search}%")
                                          ->orWhere('home_teams', 'like', "%{$search}%")
                                          ->orWhere('away_teams', 'like', "%{$search}%")
                                          ->orWhere('status', 'like', "%{$search}%")
                                          ->orWhere('match_start_time', 'like', "%{$search}%");
                                  });
                              })
                              ->when($simpleFilter === 'past', function ($query) {
                                  $query->whereDate('match_start_time', '<', today());
                              })
                              ->when($simpleFilter === 'today', function ($query) {
                                  $query->whereDate('match_start_time', today());
                              })
                              ->when($simpleFilter === 'tomorrow', function ($query) {
                                  $query->whereDate('match_start_time', today()->addDay());
                              })
                              ->when($from && $to, function ($query) use ($from, $to) {
                                  $query->whereBetween('match_start_time', [$from, $to]);
                              })
                              ->when($played === 'true', function ($query) {
                                  $query->where('match_start_time', '<=', now()->subHours(2));
                              });

            $matches = $matches->orderBy('match_start_time', 'desc')->paginate(10)->appends($request->query());

            return Inertia::render('Administrator/Matches/Index', [
                'matches'      => $matches,
                'search'       => $search,
                'simpleFilter' => $simpleFilter,
                'filters'      => [
                    'date'   => $dateFilter,
                    'from'   => $from,
                    'to'     => $to,
                    'played' => $played,
                ],
            ]);
        }

        public function create(Request $request)
        {
            return Inertia::render('Administrator/Matches/create');
        }

        public function update(Request $request, Matches $match)
        {
            return Inertia::render('Administrator/Matches/update', [
                'match' => $match,
            ]);
        }

        public function post(Request $request)
        {
            $validated = $request->validate([
                                                'league'           => 'required|string|max:255',
                                                'home_team'        => 'required|string|max:255',
                                                'away_team'        => 'required|string|max:255',
                                                'match_start_time' => 'required|date_format:Y-m-d\TH:i',
                                            ]);

            $match = new Matches();
            $match->league = $validated['league'];
            $match->home_teams = $validated['home_team'];
            $match->away_teams = $validated['away_team'];
            $match->match_start_time = $validated['match_start_time'];
            $match->status = 'pending';
            $match->save();

            return redirect()
                ->route('dashboard.matches.viewMatch', [
                    'match' => $match->id
                ])
                ->with('message', 'Match created successfully.');
        }

        public function patch(Request $request, Matches $match)
        {
            $validated = $request->validate([
                                                'league'           => 'required|string|max:255',
                                                'home_team'        => 'required|string|max:255',
                                                'away_team'        => 'required|string|max:255',
                                                'match_start_time' => 'required',
                                                'mark_as_free'     => 'required|boolean',
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
            return Inertia::render('Administrator/Matches/view', [
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
