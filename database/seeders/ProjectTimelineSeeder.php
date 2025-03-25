<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTimeline;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $projects = Project::pluck('project_id')->toArray();
        foreach ($projects as $project) {
            for ($i = 0; $i < 5; $i++) {
                ProjectTimeline::create([
                    'project_id' => $project,
                    'timeline_date' => now()->addDays($i), // Format dd-mm-yyyy
                ]);
            }
           
        }
    }
}
