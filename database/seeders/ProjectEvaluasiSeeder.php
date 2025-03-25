<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectEvaluasi;
use Illuminate\Database\Seeder;
use App\Enums\ProjectEvaluationEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectEvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    
    public function run(): void
    {
        $projects = Project::pluck('project_id')->toArray();
        $users = User::pluck('user_id')->toArray();
        $status = ProjectEvaluationEnum::values();
        $tags = ['image', 'title', 'description', 'point', 'address', 'tag', 'file attachement', 'timelines', 'date', 'amount'];
        foreach ($projects as  $project) {
            for ($i = 0; $i < 8; $i++) {
                ProjectEvaluasi::create([
                    'project_id' => $project,
                    'evaluator_id' => $users[array_rand($users)],
                    'task_comment' => fake()->paragraph(1),
                    'tag_component' => $tags[array_rand($tags)],
                    'checked' => rand(0, 1),
                    'status' => $status[array_rand($status)]
                ]);
            }
        }
        
    }
}
