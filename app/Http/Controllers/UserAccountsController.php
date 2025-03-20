<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        $search = $request->query('search');
        $users = DB::table('users')->whereNull('deleted_at');
        $stats = [
            'TotalUsers' => User::all()->count(),
        ];

        if ($search)
            $users = $users->where('name', 'like', '%' . $search . '%');

        // Apply pagination and append the query parameter 'search'
        $users = $users->paginate(10)->appends(['search' => $search]);

        $users->getCollection()->transform(function ($user) {
            $user->role_name = Role::find($user->role_id)->name;
            return $user;
        });

        return Inertia::render('Administrator/Accounts/Index', [
            'users' => $users,
            'stats' => $stats,
            'search' => $search,
        ]);
    }

    public function view(Request $request, $id)
    {
        $user = User::with([
            'transactions.package', // Eager load the package relation
            'subscriptions'
        ])->find($id);

        $can_login_as_user = Auth::user()->role_name === 'Administrator';

        return Inertia::render('Administrator/Accounts/View', [
            'user' => $user,
            'transactions' => $user->transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'transaction_id' => $transaction->transaction_reference,
                    'amount' => $transaction->amount,
                    'payment_method' => $transaction->payment_method,
                    'transaction_date' => $transaction->created_at->format('Y-m-d'),
                    'status' => $transaction->transaction_type,
                    'transaction_status' => $transaction->transaction_status,
                    'package' => $transaction->package_bought ? $transaction->package_bought->name : 'Unknown'
                ];
            }),
            'subscriptions' => $user->subscriptions,
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
