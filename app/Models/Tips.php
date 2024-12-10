<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tips extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'home_teams',
        'away_teams',
        'home_odds',
        'draw_odds',
        'away_odds',
        'predictions',
        'match_start_time',
        'status',
    ];
}
