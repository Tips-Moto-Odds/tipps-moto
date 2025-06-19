<?php

namespace App\Service;

use App\Models\User;
use Carbon\Carbon;

class BusinessPolicyService
{
    /**
     * Check if the user can view free tips based on various business rules.
     *
     * @param User $user
     * @return bool
     */
    public function canViewFreeTips(User $user): bool
    {
        $today = Carbon::today();
        $userCreatedAt = $user->created_at;
        $lastSubscriptionDate = optional($user->subscriptions()->orderBy('end_date', 'desc')->first())->end_date;
        $lastSubscriptionDate = $lastSubscriptionDate ? Carbon::parse($lastSubscriptionDate) : null;

        $daysSinceCreation = $userCreatedAt ? $userCreatedAt->diffInDays($today) : null;
        $daysSinceLastSubscription = $lastSubscriptionDate?->diffInDays($today);

        // Complex rules for viewing free tips
        return $user->subscriptions()->where('status', 'active')->where('end_date', '>', now()->toDateString())->exists()
            || ($daysSinceCreation <= 3)
            || ($daysSinceLastSubscription <= 3);
    }
}

