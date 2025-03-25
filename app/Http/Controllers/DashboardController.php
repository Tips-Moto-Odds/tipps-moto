<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        $user = Auth::user();

        switch ($user->role->name) {
            case 'SuperAdministration':
            case 'Administration':
            case 'Manager':
            case 'Moderator':
                $adminDashboardController = new AdminDashboardController();
                return $adminDashboardController->index($request);
            default:
                return Inertia::render('UserPanel/index', [
                    'user' => $user,
                    'affiliate' => $user->affiliate_details
                ]);
        }
    }
}
