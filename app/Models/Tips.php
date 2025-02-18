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
        'match_id',
        'generated_by',
        'prediction_type',
        'predictions',
        'match_start_time',
        'prediction_confidence',
        'status'
    ];
    public function matches()
    {
        return $this->belongsTo(Matches::class, 'match_id')->whereNull('deleted_at');
    }

}
