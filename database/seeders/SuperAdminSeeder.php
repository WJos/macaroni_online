<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'superAdmin', 
            'contact' => '75509104',
            'email' => 'suadmin@example.bf',
            'password' => Hash::make('password')
        ]);
        $superAdmin->assignRole('Super-Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin', 
            'contact' => '75509104',
            'email' => 'admin@example.bf',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $client = User::create([
            'name' => 'User', 
            'contact' => '75509104',
            'email' => 'user@example.bf',
            'password' => Hash::make('password')
        ]);
        $client->assignRole('User');


        // Creating Product Manager User
        $client = User::create([
            'name' => 'Client', 
            'contact' => '75509104',
            'email' => 'client@example.bf',
            'password' => Hash::make('password')
        ]);
        $client->assignRole('Client');
    }
}