<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class ProfileController extends Controller
{
    private string $folder = 'Administration/Profile';

    public function index()
    {
        return Inertia::render($this->folder . '/Account');
    }

    public function patch(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

        $user->save();

        return redirect()->back()->with('message', 'User updated successfully.');
    }

    public function patchPassword(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
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
