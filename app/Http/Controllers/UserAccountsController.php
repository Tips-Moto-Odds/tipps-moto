<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;


class UserAccountsController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->query('search'); // Correct way to get query parameter
        $users = DB::table('users')->whereNull('deleted_at');
        $stats = [
            'TotalUsers' => User::all()->count(),
        ];

        if ($search)
            $users = $users->where('name', 'like', '%' . $search . '%');


        // Apply pagination and append the query parameter 'search'
        $users = $users->paginate(15)->appends(['search' => $search]);


        return Inertia::render('Dashboards/Administrator/Accounts/Index', [
            'users'  => $users,
            'stats'  => $stats,
            'search' => $search,
        ]);
    }


    public function view(Request $request, $id)
    {
        $user = User::find($id);
        $can_login_as_user = Auth::user()->role_name == 'Administrator';

        return Inertia::render('Dashboards/Administrator/Accounts/View', [
            'user'               => $user,
            'can_log_in_as_user' => $can_login_as_user
        ]);
    }

    public function delete_user(Request $request, User $user)
    {
        // Ensure the user is an admin
        if ($request->user()->role_name !== 'Administrator')
            abort(403, 'Unauthorized action.');

        // Prevent deletion of admin accounts
        if ($user->role_name === 'Administrator')
            abort(403, 'Cannot delete an admin account.');

        // Proceed with deletion
        $user->delete();

        return redirect()->route('dashboard.user.listUsers');
    }
}
