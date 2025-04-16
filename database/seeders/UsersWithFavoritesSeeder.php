<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersWithFavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'user']);

        /** @var Collection<User> $users */
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole($role);
        }

        if (Activity::count() === 0) {
            Activity::factory(10)->create();
        }

        $activities = Activity::all();

        foreach ($users as $user) {
            $user->favoriteActivities()->attach(
                $activities->random(rand(2, 5))->pluck('id')->toArray()
            );
        }
    }
}
