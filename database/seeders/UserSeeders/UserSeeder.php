<?php

namespace Database\Seeders\UserSeeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->state([
            'role_id' => value(fn() => Role::where('name','Moderator')->first('id')),
        ])->create();

        User::factory()->count(40)->state([
            'role_id' => value(fn() => Role::where('name','Customer')->first('id')),
        ])->create();

        User::factory()->count(15)->state([
            'role_id' => value(fn() => Role::where('name','Guest')->first('id')),
        ])->create();
    }
}
