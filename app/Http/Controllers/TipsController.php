<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;

class TipsController extends Controller
{




    public function index(Request $request): Response|RedirectResponse
    {
        $search = $request->query('search');

        $tipsQuery = Tips::whereHas('matches', function ($query) use ($search) {
            $query->whereNotNull('match_id')->whereNull('deleted_at');
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('league', 'like', '%' . $search . '%')
                        ->orWhere('home_teams', 'like', '%' . $search . '%')
                        ->orWhere('away_teams', 'like', '%' . $search . '%');
                });
            }
        })->with('matches')->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Dashboards/Administrator/Tips/Index', [
            'tips' => $tipsQuery,
            'search' => $search
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'tip_type' => 'required|string|max:255',
            'prediction' => 'required|string|max:255',
            'risk_level' => 'required|string|max:255',
            'winning_status' => 'required|string|max:255',
            'mark_as_free' => 'required|boolean',

        ]);

        // Save the tip to the database
        $tip = new Tips();

        $tip->match_id = $request->input('match_id');
        $tip->generated_by = auth()->user()->id;
        $tip->prediction_type = $validated['tip_type'];
        $tip->predictions = $validated['prediction'];
        $tip->status = 'pending';
        $tip->prediction_confidence = $validated['risk_level'];
        $tip->predictions_accuracy = $request->input('predictions_accuracy', 0);
        $tip->winning_status = $validated['winning_status'];
        $tip->mark_as_free = $validated['mark_as_free'];

        $tip->save();

        // Return a response to Inertia
        return redirect()->back()->with('message', 'Tip added successfully!');
    }

    public function update(Request $request, Tips $tip): RedirectResponse
    {
        // Validate the request data
        $validated = $request->validate([
            'tip_type' => 'required|string|max:255',
            'prediction' => 'required|string|max:255',
            'risk_level' => 'required|string|max:255',
            'winning_status' => 'required|string|max:255',
            'mark_as_free' => 'required|boolean',
        ]);

        // Save the tip to the database
        $tip->match_id = $request->input('match_id');
        $tip->prediction_type = $validated['tip_type'];
        $tip->predictions = $validated['prediction'];
        $tip->status = 'pending';
        $tip->prediction_confidence = $validated['risk_level'];
        $tip->predictions_accuracy = $request->input('predictions_accuracy', 0);
        $tip->winning_status = $validated['winning_status'];
        $tip->mark_as_free = $validated['mark_as_free'];
        $tip->save();

        // Return a response to Inertia
        return redirect()->back()->with('message', 'Tip added successfully!');
    }

    public function delete(Request $request, Tips $tip)
    {
        // Delete the tip
        $tip->forceDelete();

        return [
            'message' => "Tip deleted successfully!",
            'success' => true
        ];
    }

    public function view(Request $request, Tips $tip)
    {
        return Inertia::render("Dashboards/Administrator/Tips/view", [
            'tip' => $tip
        ]);
    }

    public function searchTip(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $currentTime = now(); // Get the current time

        // Search query using Eloquent
        $results = Tips::join('matches', 'tips.match_id', '=', 'matches.id')
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('matches.league', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('matches.home_teams', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('matches.away_teams', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('tips.prediction_type', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('tips.predictions', 'LIKE', "%{$searchTerm}%");

                    // Match start time filtering (only search if input looks like a date)
                    if (strtotime($searchTerm)) {
                        $q->orWhereDate('matches.match_start_time', '=', $searchTerm);
                    }
                });
            })
            ->where('matches.match_start_time', '>=', $currentTime) // Only upcoming matches
            ->select(
                'tips.id',
                'matches.league',
                'matches.home_teams',
                'matches.away_teams',
                'matches.match_start_time',
                'tips.prediction_type',
                'tips.predictions'
            )
            ->orderBy('matches.match_start_time', 'desc') // Order by match start time (earliest first)
            ->limit(20)
            ->get();


        return response()->json($results);
    }




}
