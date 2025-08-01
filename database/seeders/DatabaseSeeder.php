<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'Raza',
            'email' => 'admin@qa.com',
            'password' => bcrypt('123'), // This hashes the password
            'role' => 'Admin',
            'department' => 'none',
            'designation' => 'none',
            'approval' => 'approved',
            'status' => 'active',
        ]);
    }
}
