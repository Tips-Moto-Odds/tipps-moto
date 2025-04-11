<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
