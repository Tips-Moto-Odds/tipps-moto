<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $user = Auth::user()->load('latestBalance');

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
