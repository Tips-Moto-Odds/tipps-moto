<?php

use App\Models\Matches;
use App\Models\Packages;
use App\Models\Subscription;
use App\Models\Tips;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FootballApiLocal;


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

    $payload = $request->all();


    foreach ($payload as $key => $match) {
        foreach ($match as $match_index => $value) {

            $away_team = $value['Away Team'];
            $home_team = $value['Home Team'];
            $league = $value['league'];
            $jackpot = $value['jackpot'];

            $date = $value['date'][0];
            $time = $value['date'][1];

            $dateTimeString = trim($date . ' ' . str_replace(' EAT', '', $time));

            $carbonDate = Carbon::createFromFormat('l, F, jS H:i', $dateTimeString, 'Africa/Nairobi');

            $timestamp = $carbonDate->toDateTimeString();

            $match = new Matches();
            $match->league = $league;
            $match->home_teams = $home_team;
            $match->away_teams = $away_team;
            $match->match_start_time = $timestamp;

            $match->save();

            $tips_list = $value['tips'];

            foreach ($tips_list as $type => $tip) {
                $prediction = null;
                $prediction_type = null;

                if ($type == '1_X_2'){
                    $prediction_type = '1-X-2';

                    if ($tip['result'] == 1){
                        $prediction = 'Home Win';
                    }else if ($tip['result'] == 0){
                        $prediction = 'Draw';
                    }else if ($tip['result'] == -1){
                        $prediction = 'Away Win';
                    }
                } else if ($type == '1X_X2_12'){
                    $prediction_type = '1X_X2_12';

                    if ($tip['result'] == 1){
                        $prediction = 'Home Win/Draw';
                    }else if ($tip['result'] == 0){
                        $prediction = 'Away Win/Draw';
                    }else if ($tip['result'] == -1){
                        $prediction = 'Home Win/Away Win';
                    }
                } else if ($type == 'GG_NG'){
                    $prediction_type = 'GG-NG';

                    if ($tip['result'] == 1){
                        $prediction = 'GG';
                    }else if ($tip['result'] == -1){
                        $prediction = 'NG';
                    }
                } else{
                    continue;
                }

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


    return $request->all();


    // Get the uploaded file
    $file = $request->file('tips');

    // Read the file content
    $file_content = file_get_contents($file->getPathname());

    // Decode the JSON content
    $json_data = json_decode($file_content, true);

    // Validate JSON data
    if (!$json_data || !is_array($json_data)) {
        return response()->json(['error' => 'Invalid JSON data.'], 401);
    }

    // Loop through "max" and "min" sections in the JSON and insert data into DB
    foreach (['max', 'min', 'avg'] as $confidence) {
        if (isset($json_data[$confidence])) {
            foreach ($json_data[$confidence] as $match) {
                // Insert each tip into the database
                DB::table('tips')->insert([
                    'match_start_time' => $match['match_data'][2][0] . ' ' . $match['match_data'][2][1], // Combine date and time
                    'home_teams' => $match['home_team'],
                    'away_teams' => $match['away_team'],
                    'home_odds' => $match['match_data'][0][0],
                    'draw_odds' => $match['match_data'][0][1],
                    'away_odds' => $match['match_data'][0][2],
                    'predictions' => $match['match_data'][1],
                    'status' => 'pending',   // Default status
                    'match_confidence' => $confidence, // Set confidence level from max or min
                    'league' => $match['match_data'][4],
                    'extra_odds' => json_encode($match['match_data'][3]), // Encode extra odds into JSON
                ]);
            }
        }
    }

    return response()->json(['message' => 'Tips added successfully']);
});

Route::get('/users', function (Request $request) {

})->middleware('auth:sanctum');


