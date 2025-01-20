<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GroupChat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserGroupChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('user_id')->toArray();
        $groupChatIds = GroupChat::pluck('group_chat_id')->toArray();

        if (empty($userIds) || empty($groupChatIds)) {
            $this->command->error('Seeder gagal: Pastikan tabel users dan group_chats memiliki data.');
            return;
        }

        $usersGroupChats = [];
        foreach ($groupChatIds as $groupChatId) {
           
            $usersGroupChats[] = [
                'user_id' => $userIds[array_rand($userIds)],
                'group_chat_id' => $groupChatId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
        }

        // Masukkan data ke tabel users_group_chats
        DB::table('users_group_chats')->insert($usersGroupChats);
    }
}
