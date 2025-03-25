<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'message_id' => Str::uuid(),
                'user_id' => User::latest()->value('user_id'),
                'avatar' => 'https://via.placeholder.com/46',
                'message' => 'Hi, how are you doing today?',
                'date' => '2025-01-17 10:15 AM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'message_id' => Str::uuid(),
                'user_id' => User::latest()->value('user_id'),
                'avatar' => 'https://via.placeholder.com/46',
                'message' => 'I am doing great, thank you!',
                'date' => '2025-01-17 10:16 AM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'message_id' => Str::uuid(),
                'user_id' => User::latest()->value('user_id'),
                'avatar' => 'https://via.placeholder.com/46',
                'message' => 'Good to hear that!',
                'date' => '2025-01-17 10:17 AM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
