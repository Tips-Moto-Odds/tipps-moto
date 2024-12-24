<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required','email', 'string', 'max:255','unique:users'],
            'phone' => ['required', 'string', 'max:255','unique:users'],
            'password' => $this->passwordRules(),
            'terms' => ['accepted', 'required'],
        ])->validate();
        dd(Role::where('name','Guest')->first());
        dd(value(value(fn() => Role::where('name','SuperAdministration')->first()->id)));


        return DB::transaction(function () use ($input) {
            return User::create([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'role_id' => value(value(fn() => Role::where('name','SuperAdministration')->first()->id))
            ]);
        });
    }
}
