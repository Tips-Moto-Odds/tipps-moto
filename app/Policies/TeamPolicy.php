<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (Auth::user() == $user){
            return true;
        }else if (Auth::user()->current_team_id === 1 ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(User $user, Team $team): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(User $user, Team $team): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(User $user, Team $team): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        if (Auth::user()->current_team_id === 1 )
            return true;

        return false;
    }
}
