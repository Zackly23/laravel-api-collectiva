<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user
        $user = new \App\Models\User();
        $user->name = 'Admin';
        $user->email = 'daviddwinugraha2@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();
    }
}
