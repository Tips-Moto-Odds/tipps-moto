<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        switch ($user->role->name) {
            case 'SuperAdministration':
            case 'Administration':
            case 'Manager':
            case 'Moderator':
                return Inertia::render('AdminDashboard', [
                    'users' => $this->stats()['users'],
                    'model' => $this->stats()['model'],
                    'payments' => $this->stats()['payments']
                ]);
            default:
                return Inertia::render('UserPanel/index', ['user' => $user]);
        }
    }

    public function subscriptions()
    {
        $user = Auth::user();
        $now = now(); // Current date & time

        $activeSubscriptions = $user->subscriptions->filter(function ($subscription) use ($now) {
            $endDate = \Carbon\Carbon::parse($subscription->end_date)->startOfDay(); // Expiry date at 00:00:00
            $updatedTime = \Carbon\Carbon::parse($subscription->updated_at)->format('H:i:s'); // Time part only

            // If expiry date is in the future, keep it
            if ($endDate->gt($now->startOfDay())) {
                return true;
            }

            // If expiry date is today, keep active until updated time is passed
            if ($endDate->equalTo($now->startOfDay()) && $updatedTime > $now->format('H:i:s')) {
                return true;
            }

            return false; // Remove expired subscriptions
        });

        return Inertia::render('UserPanel/Subscriptions', ['subscriptions' => $activeSubscriptions]);
    }



    public function Stats(): array
    {
        $users = User::all();

        return [
            'users' => $users,
            'model' => [],
            'payments' => []
        ];
    }

}
