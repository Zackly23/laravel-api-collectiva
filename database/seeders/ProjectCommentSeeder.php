<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $projects = DB::table('projects')->pluck('project_id');

        foreach ($projects as $projectId) {
            $user = DB::table('users')->inRandomOrder()->first();

            if (!$user) {
                continue;
            }

            $parentCommentIds = [];

            // Insert 5 komentar
            for ($i = 0; $i < 5; $i++) {
                $commentId = Str::uuid();
                // $parentId = $i === 0 ? null : $parentCommentIds[array_rand($parentCommentIds)];

                DB::table('project_comments')->insert([
                    'project_comment_id' => $commentId,
                    'project_id' => $projectId,
                    // 'project_comment_parent_id' => $parentId,
                    'user_id' => $user->user_id,
                    'comment' => "Komentar ke-{$i} untuk project {$projectId}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $parentCommentIds[] = $commentId;
            }
        }
    }
}
