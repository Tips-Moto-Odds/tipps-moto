<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Selection;
use App\Models\Tips;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Packages;

class SelectionController extends Controller
{
    public function index(Request $request)
    {
        $selections = Selection::orderBy('date_for','desc')->paginate(9);

        return Inertia::render('Dashboards/Manager/Selection/Index', [
            'selections' => $selections
        ]);
    }

    public function view(Request $request, Selection $selection)
    {
        // Decode tips JSON safely
        $tipsData = json_decode($selection->tips, true) ?? [];

        // Fetch match details for each tip and structure them
        $formattedTips = collect($tipsData)->map(function ($tip) {
            $match = Matches::find($tip['match_id']);

            $tip['tip_id'] = Tips::where('match_id', $match->id)
                ->where('prediction_type', $tip['prediction_type'])
                ->first()->id;


            return [
                'tip_id' => $tip['tip_id'] ?? null,
                'match_id' => $tip['match_id'],
                'match_start_time' => $match->match_start_time ?? null,
                'home_teams' => $match->home_teams ?? null,
                'away_teams' => $match->away_teams ?? null,
                'league' => $match->league ?? null,
                'mark_as_free' => $tip['mark_as_free'] ?? "0",
                'prediction_type' => $tip['prediction_type'],
                'predictions' => $tip['prediction'],
            ];
        });

        return Inertia::render('Dashboards/Manager/Selection/View', [
            'selection' => $selection,
            'packages' => Packages::all(),
            'tips' => $formattedTips
        ]);
    }


    public function create(Request $request)
    {

        $packages = Packages::all();

        return Inertia::render('Dashboards/Manager/Selection/create', [
            'packages' => $packages
        ]);
    }

    public function store(Request $request)
    {

        $selection = new Selection();

        $selection->package_id = $request->input('packages');
        $selection->date_for = $request->input('date_for');
        $selection->status = $request->input('active');

        $tips = collect($request->input('tips'))->map(function ($tip) {
            $db_tip = Tips::find($tip['id']);
            $db_match = $db_tip->matches;
            $tip = array(
                "match_id" => $db_match->id,
                "prediction_type" => $db_tip->prediction_type,
                "prediction" => $db_tip->predictions,
                "confidence" => $db_tip->prediction_confidence,
            );

            return $tip;
        });

        $selection->tips = json_encode($tips);
        $selection->save();

        return redirect()->route('dashboard.selection.listSelections');
    }

    public function update(Request $request, Selection $selection)
    {
        // Get input tips
        $inputTips = $request->input('tips', []);

        // Transform the tips into the required format
        $formattedTips = collect($inputTips)->map(function ($tip) {
            // Fetch match associated with the tip (assuming relationship exists)
            $tipModel = Tips::find($tip['tip_id']);
            $match = $tipModel ? $tipModel->matches : null;


            return [
                'match_id' => $match ? $match->id : null, // Get match ID from relation
                'prediction_type' => $tip['prediction_type'] ?? null,
                'prediction' => $tip['predictions'] ?? null,
                'confidence' => $tipModel->prediction_confidence ?? 'min' // Default if missing
            ];
        })->toArray();

        // Save the transformed tips as JSON
        $selection->package_id = $request->input('packages');
        $selection->date_for = $request->input('date_for');
        $selection->status = $request->input('active');
        $selection->tips = json_encode($formattedTips, JSON_PRETTY_PRINT); // Encode properly

        $selection->save();

        return redirect()->route('dashboard.selection.listSelections');
    }

    public function delete(Request $request, Selection $selection)
    {
        $selection->delete();

        return redirect()->route('dashboard.selection.listSelections');
    }
}
