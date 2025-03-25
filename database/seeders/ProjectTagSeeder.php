<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Project;
use App\Models\ProjectTag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectTags = Tag::pluck('tag_id')->toArray();
        $projectsId = Project::pluck('project_id')->toArray();

        foreach ($projectsId as $projectId) {
            $tags = collect($projectTags)->shuffle()->take(5)->toArray();
            foreach ($tags as $tag) {
                ProjectTag::create([
                    'project_id' => $projectId,
                    'tag_id' => $tag,

                ]);
            }
        }
    }
}
