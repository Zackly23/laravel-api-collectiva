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
        $user = new User();
        $user->user_id = Str::uuid();
        $user->name = 'David Dwi Nugroho';
        $user->email = 'daviddwinugraha2@gmail.com';
        $user->password = bcrypt('pass123');
        $user->email_verified_at = now();

        $user->save();
    }
}
