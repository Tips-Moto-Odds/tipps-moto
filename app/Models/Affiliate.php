<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'referred_by',
        'referral_code',
        'total_referrals',
        'total_earnings',
        'withdrawn_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'total_referrals' => 'integer',
        'total_earnings' => 'decimal:2',
        'withdrawn_amount' => 'decimal:2',
    ];

    /**
     * Get the user who is an affiliate.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who referred this affiliate.
     */
    public function referrer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    /**
     * Get all users referred by this affiliate.
     */
    public function referrals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Affiliate::class, 'referred_by');
    }

    /**
     * Get the remaining balance (earnings - withdrawn).
     */
    public function getBalanceAttribute()
    {
        return $this->total_earnings - $this->withdrawn_amount;
    }

    public function referees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Affiliate::class, 'referred_by');
    }
}
