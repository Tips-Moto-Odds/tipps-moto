<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserAccountsController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Dashboards/Administrator/Accounts/Index', [
            'users' =>  User::paginate(15),
        ]);
    }

    public function view(Request $request, $id)
    {
        $user =  User::find($id);
        $can_login_as_user = $user->role_name == 'Administrator';

        return Inertia::render('Dashboards/Administrator/Accounts/View', [
            'user' => $user,
            'can_log_in_as_user' => $can_login_as_user
        ]);
    }

    public function logInAs(Request $request, User $user)
    {
        // Ensure the current user is an admin
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Store the current admin's user ID in the session
        Session::put('admin_id', Auth::id());

        // Log in as the specified user
        Auth::login($user);

        return redirect('/dashboard');
    }

    public function returnToAdmin(Request $request, User $user): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        // Retrieve the original admin ID from the session
        $adminId = Session::get('admin_id');

        if ($adminId) {
            // Log back in as the admin
            $admin = User::find($adminId);
            Auth::login($admin);

            // Remove the admin_id from the session
            Session::forget('admin_id');

            return redirect('/dashboard');
        }

        return redirect('/login')->with('error', 'Unable to return to admin account.');
    }

    public function delete_user(Request $request, User $user)
    {
        dd($user);
    }
}
