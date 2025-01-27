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
        $user = User::where('name', 'SuperAdministration')->first();

        if ($user === null) {
            User::factory()->create([
                'name'              => 'SuperAdministration',
                'phone'             => '0700000000',
                'email'             => 'superadminisrtator@email.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password'),
                'role_id'          => value(value(fn() => Role::where('name','Guest')->first()->id))
            ]);
        }
    }
}
