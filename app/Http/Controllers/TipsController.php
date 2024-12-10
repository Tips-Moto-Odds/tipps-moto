<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TipsController extends Controller
{
    public function index(Request $request): \Inertia\Response|\Illuminate\Http\RedirectResponse
    {
        $user_data = [];
        $search = $request->query('search'); // Correct way to get query parameter


        switch (Auth::user()->role->name) {
        case 'Administrator':
        case 'Moderator':
            // Start building the query
            $tipsQuery = DB::table('tips')->whereNull('deleted_at');

            // Apply search filter if it exists
            if ($search) {
                $tipsQuery = $tipsQuery->where(function ($query) use ($search) {
                    $query->where('home_teams', 'like', '%' . $search . '%')
                        ->orWhere('away_teams', 'like', '%' . $search . '%');
                });
            }

            // Order and paginate results
            $tips = $tipsQuery->orderBy('match_start_time', 'desc')->paginate(15);

            return Inertia::render('Dashboards/Administrator/Tips/Index', [
                'tips'      => $tips,
                'user_data' => $user_data,
                'search'    => $search
            ]);

        case 'Customer':
        case 'Guest':

            if (!empty(Auth::user()->active_subscription)) {
                $user_data['subscriptions_details'] = Auth::user()->active_subscription;
                $tips = Tips::orderBy('match_start_time', 'desc')->paginate(10);

            }

            return Inertia::render("Dashboards/User/Tips/Index", [
                'tips'      => $tips,
                'user_data' => $user_data,
                'search'    => null
            ]);

        default:
            return redirect()->back();
        }
    }

    public function update(Request $request, Tips $tip): \Illuminate\Http\RedirectResponse
    {
        // Validate the request
        $request->validate([
            'home_teams'       => 'required|string|max:255',
            'away_teams'       => 'required|string|max:255',
            'home_odds'        => 'required|numeric', // Ensure odds are numeric
            'draw_odds'        => 'required|numeric',
            'away_odds'        => 'required|numeric',
            'predictions'      => 'required|string|max:255', // Assuming predictions is a string
            'match_start_time' => 'required|date',
            'status'           => 'required|string|max:255',
            'extra_odds'       => 'nullable|array', // Make sure to allow extra_odds as nullable
        ]);

        // Set extra_odds if present and encode it to JSON
        $tip->extra_odds = json_encode($request->input('extra_odds'));
        $tip->winning_status = $request->input('winning_status');

        // Remove extra_odds from the request data before updating
        $data = $request->except('extra_odds', 'winning_status');

        // Update the tip with the validated data
        $tip->update($data);

        return redirect()->back()->with('success', 'Tip updated successfully!');
    }

    public function delete(Request $request, Tips $tip): \Illuminate\Http\RedirectResponse
    {
        // Delete the tip
        $tip->delete();

        // Redirect to the specified route
        return redirect()->route('dashboard.tips.listTips')->with('success', 'Tip deleted successfully!');
    }


    public function view(Request $request, Tips $tip)
    {
        return Inertia::render("Dashboards/Administrator/Tips/view", [
            'tip' => $tip
        ]);
    }
}
