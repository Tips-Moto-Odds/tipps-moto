<?php

namespace App\Modules;

use App\Models\Matches;
use Illuminate\Support\Facades\Log;

class MatchModule
{
    public function findOrCreateMatch($matchData)
    {
        $existing_match = Matches::where('home_teams', $matchData['Home Team'])
            ->where('away_teams', $matchData['Away Team'])
            ->where('match_start_time', $matchData['date'])
            ->first();

        if ($existing_match) {
            Log::info("Match Found: {$existing_match->id} - {$existing_match->home_teams} vs {$existing_match->away_teams}");
            return $existing_match;
        }

        $new_match = Matches::create([
            'home_teams' => $matchData['Home Team'],
            'away_teams' => $matchData['Away Team'],
            'match_start_time' => $matchData['date'],
            'league' => $matchData['league']
        ]);

        Log::info("New Match Created: {$new_match->id} - {$new_match->home_teams} vs {$new_match->away_teams}");
        return $new_match;
    }
}
