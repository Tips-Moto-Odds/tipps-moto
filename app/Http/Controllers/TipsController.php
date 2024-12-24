<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use JetBrains\PhpStorm\NoReturn;

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
}
