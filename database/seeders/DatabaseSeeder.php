<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create the Super Admin role if it doesn't exist
        Role::firstOrCreate(
            ['name' => 'superadmin', 'guard_name' => 'web']
        );

        // Assign the Super Admin role to the user
        $user->assignRole('superadmin');
    }
}
