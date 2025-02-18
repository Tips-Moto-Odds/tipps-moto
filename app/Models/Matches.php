<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
