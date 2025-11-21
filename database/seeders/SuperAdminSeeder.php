<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@jerukpin.com',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: admin@jerukpin.com');
        $this->command->info('Password: password');
    }
}
