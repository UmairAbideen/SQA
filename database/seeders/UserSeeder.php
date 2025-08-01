<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username'    => 'raza',
            'email'       => 'admin@qa.com',
            'password'    => Hash::make('123'), // Hash the password
            'org'         => 'SES',
            'ses_no'      => '001',
            'role'        => 'admin',
            'department'  => 'QA',
            'designation' => 'Officer',
            'approval'    => 'approved',
            'status'      => 'active',
            // 'remember_token' => \Str::random(10),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
