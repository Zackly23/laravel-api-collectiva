<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua UUID dari tabel Users dan Projects
        $userIds = User::pluck('user_id')->toArray(); // Asumsikan kolom primary key user adalah 'id'
        $projectIds = Project::pluck('project_id')->toArray();
        
        if (empty($userIds) || empty($projectIds)) {
            $this->command->error('Seeder gagal: Pastikan tabel users dan projects memiliki data.');
            return;
        }

        // Data dummy untuk group chats
        $groupChats = [
            [
                'group_chat_id' => Str::uuid(),
                'group_chat_name' => 'Development Team Chat',
                'initiator_user_id' => $userIds[array_rand($userIds)],
                'project_id' => $projectIds[array_rand($projectIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_chat_id' => Str::uuid(),
                'group_chat_name' => 'Marketing Team Chat',
                'initiator_user_id' => $userIds[array_rand($userIds)],
                'project_id' => $projectIds[array_rand($projectIds)],
                'created_at' => now()->addMinute(1),
                'updated_at' => now()->addMinute(1),
            ],
            [
                'group_chat_id' => Str::uuid(),
                'group_chat_name' => 'QA Team Chat',
                'initiator_user_id' => $userIds[array_rand($userIds)],
                'project_id' => $projectIds[array_rand($projectIds)],
                'created_at' => now()->addMinute(2),
                'updated_at' => now()->addMinute(2),
            ],
            [
                'group_chat_id' => Str::uuid(),
                'group_chat_name' => 'Backend Team Developer',
                'initiator_user_id' => $userIds[array_rand($userIds)],
                'project_id' => $projectIds[array_rand($projectIds)],
                'created_at' => now()->addMinute(3),
                'updated_at' => now()->addMinute(3),
            ],
            [
                'group_chat_id' => Str::uuid(),
                'group_chat_name' => 'Frontend Team',
                'initiator_user_id' => $userIds[array_rand($userIds)],
                'project_id' => $projectIds[array_rand($projectIds)],
                'created_at' => now()->addMinute(4),
                'updated_at' => now()->addMinute(4),
            ],
        ];

        // Masukkan data ke tabel group_chats
        DB::table('group_chats')->insert($groupChats);
    }
}
