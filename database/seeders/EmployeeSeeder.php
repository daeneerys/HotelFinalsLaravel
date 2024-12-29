<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeSeeder extends Seeder
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
            'first_name' => 'Ed',
            'last_name' => 'Caluag',
            'email' => 'edcaluag@gmail.com',
            'phone_number' => '09760254695',
            'password' => Hash::make('employee01'), // Replace with a secure password
            'role' => 'employee',
        ]);
    }
}
