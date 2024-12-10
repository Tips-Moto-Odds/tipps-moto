<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class AccountsTypeController extends Controller
{
    private string $folder = 'Administration/Administration';

    public function index(Request $request): Response
    {
        $accountTypes = Team::all();

        $accountTypes->map(function ($accountType) {
            $accountType->user_count = DB::select('select count(id) as users from users where current_team_id = ?', [$accountType->id])[0]->users;
            return $accountType;
        });

        return Inertia::render($this->folder.'/AccountTypes',[
            'accountTypes' =>$accountTypes
        ]);
    }

    public function view(Request $request, $accountTypeId): Response
    {
        $accountType = Team::find($accountTypeId);
        $users = User::where('current_team_id', $accountTypeId)->get();

        return Inertia::render($this->folder.'/AccountType',[
            'accountType' => $accountType,
            'users' => $users
        ]);
    }

    public function patch(Request $request, $accountTypeId): JsonResponse|RedirectResponse
    {
        // Find the account type by ID
        $accountType = Team::findOrFail($accountTypeId);

        if (!Gate::allows('update',$accountType)){
            return response()->json(['message' => 'Unauthorised'],403);
        }

        $accountType->name = $request->get('name');
        $accountType->status = $request->get('status');

        $accountType->save();

        return redirect()->back()->with('success', 'Account Type Updated');
    }

    public function post(Request $request): JsonResponse|RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:199|unique:teams',
            'status' => 'required|string',
        ]);

        if (!Gate::allows('create',Team::class)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $accountType = new Team();
        $accountType->name = $request->get('name');
        $accountType->user_id = Auth::user()->id;
        $accountType->personal_team = 1;
        $accountType->status = $request->get('status');

        $accountType->save();

        return redirect()->back()->with('success', 'Account Type Updated');
    }

    public function delete(Request $request,Team $team): RedirectResponse
    {
        if (!Gate::allows('delete',$team)) {
            abort(403, 'Unauthorized action.');
        }

        $team->delete();

        return redirect()->back()->with('success', 'Account Type Deleted');
    }

    public function searchUser(Request $request)
    {
        $username = $request->get('searchUserText');

        $users = User::where('name','LIKE','%'.$request->get('searchUserText').'%')->get();

        if ($users->count() <= 0) {
            abort(404, 'User Not Found');
        }


        return response()->json($users);
    }

    public function assignRole(Request $request,Team $team,User $user)
    {
        $current_user = Auth::user();

        if($current_user->current_role->name != 'Administrator'){
            abort(403, 'Unauthorized action.');
        }

        $user->current_team_id = $team->id;
        $user->save();

        return response()->json(['message' => 'User Role Updated']);
    }
}
