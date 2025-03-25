<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use App\Models\GroupChat;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageGroupChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupChatIds = GroupChat::pluck('group_chat_id')->toArray();
        $chatIds = Chat::pluck('chat_id')->toArray();
        $userIds = User::pluck('user_id')->toArray();

        // Periksa apakah tabel terkait memiliki data
        if (empty($groupChatIds) || empty($chatIds)) {
            $this->command->error('GroupChat or Chat table is empty. Please seed those tables first.');
            return;
        }

        $data = [];

        // Loop melalui chat_id dan hubungkan ke group_chat_id secara acak
        foreach ($chatIds as $index => $chatId) {
            $data[] = [
                'message_group_chat_id' => Str::uuid(),
                'group_chat_id' => $groupChatIds[array_rand($groupChatIds)], // Pilih group_chat_id secara acak
                'sender_id' => $userIds[array_rand($userIds)],
                'group_chat_text' => fake()->sentence(),
                'media_path' => fake()->optional()->imageUrl(),
                'created_at' => now()->addDay($index),
                'updated_at' => now()->addDay($index),
            ];
        }

        // Masukkan data ke dalam tabel message_group_chats
        DB::table('message_group_chats')->insert($data);

    }
}
