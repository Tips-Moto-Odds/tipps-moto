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
        User::factory()->count(100)->state([
            'role_id' => value(fn() => Role::where('name','Guest')->first('id')),
        ])->create();

        User::factory()->count(200)->state([
            'role_id' => value(fn() => Role::where('name','User')->first('id')),
        ])->create();

        User::factory()->count(2)->state([
            'role_id' => value(fn() => Role::where('name','Moderator')->first('id')),
        ])->create();

        User::factory()->count(3)->state([
            'role_id' => value(fn() => Role::where('name','Manager')->first('id')),
        ])->create();

        User::factory()->count(2)->state([
            'role_id' => value(fn() => Role::where('name','Administration')->first('id')),
        ])->create();

        User::factory()->count(2)->state([
            'role_id' => value(fn() => Role::where('name','SuperAdministration')->first('id')),
        ])->create();
    }
}
