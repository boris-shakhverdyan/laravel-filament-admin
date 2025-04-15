<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['admin', 'editor', 'viewer', 'user'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        /** @var User $admin */
        $admin = User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123123123'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');
    }
}
