<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
//    TODO: check for usage
    public function index()
    {
//        if (Auth::user()->is_admin())
//            return Inertia::render("Dashboards/Administrator/Profile/Account");
//        else
//            return Inertia::render("Users/Profile/Account");
        return Inertia::render("Dashboards/Administrator/Profile/Account");
    }

    public function patch(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'sometimes|string|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function patchPassword(Request $request, User $user): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'password'         => 'required|string|min:8|confirmed',
            'current_password' => 'required|string',
        ]);

        // Check if the provided current password matches the stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back()->with('message', 'Password updated successfully.');
    }
}
