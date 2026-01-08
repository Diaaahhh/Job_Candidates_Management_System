<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create([
            'name' => 'Admin',
            'description' => 'Full access to all features'
        ]);

        $staffRole = Role::create([
            'name' => 'Staff',
            'description' => 'Can upload Excel files and view all lists (read-only)'
        ]);

        $candidateRole = Role::create([
            'name' => 'Candidate',
            'description' => 'Can only view their own status'
        ]);

        // Create default admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole->id);

        $this->command->info('Roles and default admin user created successfully!');
        $this->command->info('Admin credentials: admin@example.com / password');
    }
}
