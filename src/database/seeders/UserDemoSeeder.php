<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            "name" => "User Demo",
            "email" => "userdemo@gmail.com",
            "password" => bcrypt("password123"),
            "created_at" => now(),
        ]);
    }
}
