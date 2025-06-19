<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @method static firstOrNew(array $array)
 */
class Tips extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'match_id',
        'generated_by',
        'prediction_type',
        'predictions',
        'match_start_time',
        'prediction_confidence',
        'status'
    ];

    public function matches(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'match_id')->whereNull('deleted_at');
    }

    public static function getFreeUpcomingTips()
    {
        return self::join('matches as m', 'tips.match_id', '=', 'm.id')
            ->whereNull('m.deleted_at')
            ->where('tips.mark_as_free', 1)
            ->where('m.match_start_time', '>=', Carbon::now())
            ->select(
                'tips.id as tip_id',
                'm.id as match_id',
                'm.league',
                'm.home_teams',
                'm.away_teams',
                'm.match_start_time',
                'tips.mark_as_free',
                'tips.prediction_type',
                'tips.predictions'
            )
            ->orderBy('m.match_start_time', 'asc')
            ->limit(3)
            ->get();
    }

}
