<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Default credentials
         User::create([
            'name' => 'ScrewlooseIT (Super Admin)',
            'email' => 'support@screwlooseit.com.au',
            'email_verified_at' => now(),
            'password' =>
                '$2y$10$67Q1fbWY5nDz.79PXz.I9eYSvMj44GJNVfpF8qnUu4tAulDQ8m1u6', // AlexJas123!@#
            'active' => 1,
            'role_type' => 'super admin',
            'remember_token' => Str::random(10),
         ])->assignRole('super admin');    
    }
}
