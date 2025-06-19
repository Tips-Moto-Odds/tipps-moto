<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @method static where(array $array)
 * @method static updateOrCreate(array $array, string[] $array1)
 * @method static withCount(string $string)
 */
class Matches extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'league',
        'home_teams',
        'away_teams',
        'match_start_time',
        'status'
    ];

    public function tips()
    {
        return $this->hasMany(Tips::class, 'match_id');
    }

    public static function getYesterdaysMatchesWithTips()
    {
        return self::with('tips')
            ->whereHas('tips', function ($query) {
                $query->whereIn('winning_status', ['Won']);
            })
            ->whereBetween('match_start_time', [Carbon::yesterday()->startOfDay(), Carbon::yesterday()->endOfDay()])
            ->inRandomOrder()
            ->limit(15) // Ensures only 15 matches are retrieved from DB
            ->get()
            ->sortBy('match_start_time')
            ->flatMap(fn($match) => $match->tips
                ->whereIn('winning_status', ['Won', 'Lost']) // Filter tips here
                ->map(fn($tip) => [
                    'match_start_time' => $match->match_start_time,
                    'home_teams' => $match->home_teams,
                    'away_teams' => $match->away_teams,
                    'prediction_type' => $tip->prediction_type,
                    'predictions' => $tip->predictions,
                ])
            )
            ->shuffle()
            ->take(15)
            ->values();
    }
}
