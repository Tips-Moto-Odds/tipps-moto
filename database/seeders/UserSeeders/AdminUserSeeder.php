<?php

namespace Database\Seeders\UserSeeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('name', 'Administrator')->first();

        if ($user == null) {
            User::factory()->create([
                'name'              => 'Administrator',
                'phone'             => '0719445697',
                'email'             => 'administrator@tipsmoto.co.ke',
                'email_verified_at' => now(),
                'password'          => bcrypt('password'),
                'role_id'          => value(fn() => Role::where('name', 'Administrator')->first('id'))
            ]);
        }
    }
}
