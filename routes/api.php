<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FootballApiLocal;


Route::get('/test', [FootballApiLocal::class, 'postAPI']);

Route::post('/postTips', function (Request $request) {
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
    foreach (['max', 'min','avg'] as $confidence) {
        if (isset($json_data[$confidence])) {
            foreach ($json_data[$confidence] as $match) {
                // Insert each tip into the database
                DB::table('tips')->insert([
                    'match_start_time' => $match['match_data'][2][0] . ' ' . $match['match_data'][2][1], // Combine date and time
                    'home_teams'       => $match['home_team'],
                    'away_teams'       => $match['away_team'],
                    'home_odds'        => $match['match_data'][0][0],
                    'draw_odds'        => $match['match_data'][0][1],
                    'away_odds'        => $match['match_data'][0][2],
                    'predictions'      => $match['match_data'][1],
                    'status'           => 'pending',   // Default status
                    'match_confidence' => $confidence, // Set confidence level from max or min
                    'league'           => $match['match_data'][4],
                    'extra_odds'       => json_encode($match['match_data'][3]), // Encode extra odds into JSON
                ]);
            }
        }
    }

    return response()->json(['message' => 'Tips added successfully']);
});

Route::get('/users', function (Request $request) {

})->middleware('auth:sanctum');


//$searchTerm = $request->input('search_term');
//
//$users = DB::table('users');
//
//if ($searchTerm) {
//    $users->where('name', 'LIKE', '%' . $searchTerm . '%');
//}
//
//$result = $users->paginate(); // Fetch the results
//
//return response()->json($result); // Return the results as a JSON response

