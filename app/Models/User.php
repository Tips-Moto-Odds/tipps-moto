<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, HasProfilePhoto, HasTeams, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'current_team_id',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'role_name'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is an admin or moderator.
     */
    public function is_admin(): bool
    {
        return in_array($this->role_name, ['Administrator', 'Moderator']);
    }

    /**
     * Get the user's role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the active subscription of the user.
     */
    public function active_subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->whereDate('end_date', '>', today());
    }

    /**
     * Get the user's role name.
     */
    public function getRoleNameAttribute(): string
    {
        return $this->role ? $this->role->name : 'Guest';
    }

    /**
     * Get all subscriptions of the user.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class)->latest();
    }

    /**
     * Get all transactions of the user.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all users referred by this user.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(Affiliate::class, 'referred_by');
    }

    /**
     * Get the user who referred this user.
     */
    public function referrer(): HasOne
    {
        return $this->hasOne(Affiliate::class, 'user_id');
    }

    public function affiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class, 'user_id');
    }


    /**
     * Scope to filter users who exist in the affiliates table.
     */
    public function scopeAffiliates($query)
    {
        return $query->whereHas('referrer');
    }

}
