<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        $user = User::where('name', 'Administrator')->first();


        if ($user == null) {
            $Admin = User::factory()->withPersonalTeam()->create([
                'name' => 'Administrator',
                'email' => 'admin@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ]);

            $Admin->ownedTeams()->create([
                'name' => 'user',
                'personal_team' => false,
            ]);
        }
    }
}
