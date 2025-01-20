<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'project_id' => Str::uuid(),
                'project_name' => 'Project Alpha',
                'strat_date' => now()->subDays(10)->format('Y-m-d H:i:s'),
                'end_date' => now()->addDays(20)->format('Y-m-d H:i:s'),
                'target_amount' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => Str::uuid(),
                'project_name' => 'Project Beta',
                'strat_date' => now()->subDays(15)->format('Y-m-d H:i:s'),
                'end_date' => now()->addDays(25)->format('Y-m-d H:i:s'),
                'target_amount' => 1000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => Str::uuid(),
                'project_name' => 'Project Gamma',
                'strat_date' => now()->subDays(20)->format('Y-m-d H:i:s'),
                'end_date' => now()->addDays(30)->format('Y-m-d H:i:s'),
                'target_amount' => 750000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
