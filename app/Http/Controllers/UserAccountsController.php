<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserAccountsController extends Controller
{
    public function index(): \Inertia\Response
    {
        //get all users
        $users = User::all();

        //format the dates
        $users->map(function ($userItem) {
            try {
                $userItem->DateJoined = [
                    'time' => ($userItem->created_at)->format('h:i A'),
                    'date' => ($userItem->created_at)->format('F j, Y'),
                ];

                $result = collect(DB::select('SELECT * FROM sessions WHERE user_id = ? Limit 1', [$userItem->id]))->last();

                $userItem->activity = [
                    'date' => date('F j, Y ', $result->last_activity),
                    'time' => date('g:i A', $result->last_activity),
                ];
            } catch (\Exception $e) {
                logger($e->getMessage());
            }
        });

        return Inertia::render('Administration/Manage/Accounts/Index', [
            'users' => $users,
            'stats' => [
                'total' => $users->count(),
            ]
        ]);
    }

    public function delete_user(Request $request, User $user)
    {
        dd($user);
    }
}
