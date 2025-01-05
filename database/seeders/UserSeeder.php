<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new User();
        $user->first_name = 'David';
        $user->last_name = 'Dwi Nugroho';
        $user->email = 'daviddwinugraha2@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();
    }
}
