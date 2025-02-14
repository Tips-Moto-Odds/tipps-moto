<?php

use App\Models\Matches;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Tips;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('/onit/response', function () {
    Log::info(request()->all());
})->name('');

Route::post('/onit/deposit/response', function (Request $request) {
    if ($request->has('originatorRequestId')) {
        $transaction_string = $request->input('originatorRequestId');
        $code = explode('|', $transaction_string);
        $code = $code[1];

        $transaction = Transaction::where('transaction_reference', $code)->first();

        if ($transaction) {
            $transaction->transaction_status = 'successful';

            $package = Packages::find($transaction->package_id);
            $endDate = now()->addDays($package->period);

            $subscription = new Subscription();
            $subscription->user_id = $transaction->user_id;
            $subscription->package_id = $package->id;
            $subscription->start_date = now()->format('Y-m-d');
            $subscription->end_date = $endDate->format('Y-m-d');
            $subscription->status = 'active';
            $subscription->transaction_id = $transaction->id;

            $transaction->save();
            $subscription->save();
        } else {
            Log::info("Transaction not found");
        }
    } else {
        dd('Transaction failed');
    }
})->name('');

Route::post('/onit/withdraw/response', function () {
    Log::info(request()->all());
})->name('');

Route::post('/postTips', function (Request $request) {

    return response()->json($request->input());

    $payload = $request->all();


    foreach ($payload as $key => $match) {
        foreach ($match as $match_index => $value) {

            $away_team = $value['Away Team'];
            $home_team = $value['Home Team'];
            $league = $value['league'];
            $timestamp = $value['date'];

            // 🔹 Check if the match already exists
            $existing_match = Matches::where('home_teams', $home_team)
                ->where('away_teams', $away_team)
                ->where('match_start_time', $timestamp)
                ->where('league', $league)
                ->first();

            if ($existing_match) {
                $match = $existing_match; // Use the existing match
            } else {
                // 🔹 Create a new match if it doesn't exist
                $match = new Matches();
                $match->league = $league;
                $match->home_teams = $home_team;
                $match->away_teams = $away_team;
                $match->match_start_time = $timestamp;
                $match->save();
            }

            // 🔹 Process tips
            $tips_list = $value['tips'];

            foreach ($tips_list as $type => $tip) {
                $prediction = null;
                $prediction_type = null;

                if ($type == '1_X_2') {
                    $prediction_type = '1-X-2';
                    if ($tip['result'] == 1) {
                        $prediction = 'Home Win';
                    } elseif ($tip['result'] == 0) {
                        $prediction = 'Draw';
                    } elseif ($tip['result'] == -1) {
                        $prediction = 'Away Win';
                    }
                } elseif ($type == '1X_X2_12') {
                    $prediction_type = '1X_X2_12';
                    if ($tip['result'] == 1) {
                        $prediction = 'Home Win/Draw';
                    } elseif ($tip['result'] == 0) {
                        $prediction = 'Away Win/Draw';
                    } elseif ($tip['result'] == -1) {
                        $prediction = 'Home Win/Away Win';
                    }
                } elseif ($type == 'GG_NG') {
                    $prediction_type = 'GG-NG';
                    if ($tip['result'] == 1) {
                        $prediction = 'GG';
                    } elseif ($tip['result'] == -1) {
                        $prediction = 'NG';
                    }
                } else {
                    continue;
                }

                // 🔹 Check if the tip already exists for this match and prediction type
                $existing_tip = Tips::where('match_id', $match->id)
                    ->where('prediction_type', $prediction_type)
                    ->first();

                if ($existing_tip) {
                    // 🔹 Update the tip only if the prediction has changed
                    if ($existing_tip->predictions !== $prediction) {
                        $existing_tip->predictions = $prediction;
                        $existing_tip->prediction_confidence = $key; // Update confidence level
                        $existing_tip->save();
                    }
                } else {
                    // 🔹 Insert a new tip if it doesn't exist
                    $tip_model = new Tips();
                    $tip_model->match_id = $match->id;
                    $tip_model->generated_by = 1;
                    $tip_model->prediction_type = $prediction_type;
                    $tip_model->predictions = $prediction;
                    $tip_model->prediction_confidence = $key;
                    $tip_model->save();
                }
            }
        }
    }

    return $request->all();
});

Route::get('/users', function (Request $request) {

})->middleware('auth:sanctum');


