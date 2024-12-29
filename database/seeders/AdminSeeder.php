<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Check if a user with the same email already exists
        // $existingUser = User::where('email', 'tigerdenhotel2024@gmail.com')->first();
        
        // // If the user exists, delete it
        // if ($existingUser) {
        //     $existingUser->delete();
        // }
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'TigerDen',
            'email' => 'tigerdenhotel2024@gmail.com',
            'phone_number' => '09770254695',
            'password' => Hash::make('adminpassword01'), // Replace with a secure password
            'role' => 'admin',
        ]);
    }
}
