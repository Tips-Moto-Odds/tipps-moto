<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

class AccountBalance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'amount',
        'balance_after',
        'reason',
        'reference',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Optional: Validate integrity before saving
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!isset($model->balance_after)) {
                throw new InvalidArgumentException('balance_after must be calculated and set explicitly.');
            }

            if (is_null($model->user_id)) {
                throw new InvalidArgumentException('user_id is required for account balance entries.');
            }
        });
    }
}
