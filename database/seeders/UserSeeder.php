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

        $user = new User();
        $user->first_name = 'Caroline';
        $user->last_name = 'Chan';
        $user->email = 'carolinechan123@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->first_name = 'Ariel';
        $user->last_name = 'Tarigan';
        $user->email = 'arieltarigan123@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->first_name = 'Adi';
        $user->last_name = 'Maruf';
        $user->email = 'adimaruf@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->first_name = 'Intan';
        $user->last_name = 'Rapsodi';
        $user->email = 'intanrapsodi123@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();

        $user = new User();
        $user->first_name = 'Wahyu';
        $user->last_name = 'Marwanto';
        $user->email = 'wahyu123@gmail.com';
        $user->password = bcrypt('password123');
        $user->email_verified_at = now();
        $user->save();
    }
}
