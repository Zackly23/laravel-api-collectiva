<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'daviddwinugraha2@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();
    }
}
