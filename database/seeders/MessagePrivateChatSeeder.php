<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagePrivateChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('user_id')->toArray();
        $chatIds = Chat::pluck('chat_id')->toArray();

        // Periksa apakah tabel terkait memiliki data
        if (empty($userIds) || empty($chatIds)) {
            $this->command->error('GroupChat or Chat table is empty. Please seed those tables first.');
            return;
        }

        $data = [];

        // Loop melalui chat_id dan hubungkan ke group_chat_id secara acak
        foreach ($chatIds as $index => $chatId) {
            $data[] = [
                'message_private_chat_id' => Str::uuid(),
                'user_id' => $userIds[array_rand($userIds)], // Pilih group_chat_id secara acak
                'sender_id' => $userIds[array_rand([1,2,3,4,5,6])],
                'private_chat_text' => fake()->sentence(),
                'media_path' => fake()->optional()->imageUrl(),
                'created_at' => now()->addDays($index),
                'updated_at' => now()->addDays($index),
            ];
        }

        // Masukkan data ke dalam tabel message_group_chats
        DB::table('message_private_chats')->insert($data);
        
    }
}
