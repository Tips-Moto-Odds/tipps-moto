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
