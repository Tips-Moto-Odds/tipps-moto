<?php

namespace App\Actions\Fortify;

use App\Models\Affiliate;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param array<string, string> $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => ['accepted', 'required'],
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = new User([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'role_id' => Role::where('name', 'Guest')->first()->id,
            ]);

            $user->save();

            $affiliate = $this->getAffiliateLink();

            if ($affiliate) {
                Affiliate::create([
                    'user_id' => $user->id,
                    'referred_by' => $affiliate->user_id,
                ]);

                ++$affiliate->total_referrals;
                $affiliate->save();

                Log::info("{$user->name} was referred by affiliate with ID {$affiliate->user_id}");
            }

            return $user;
        });
    }

    private function getAffiliateLink()
    {
        $code = request()->cookie('affiliateLink');

        if ($code) {
            return Affiliate::where('referral_code', $code)->first();
        }

        return null;
    }
}
