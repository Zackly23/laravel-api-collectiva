<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Support\Str;
use App\Models\ProjectTimeline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTimelineDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

 

     public function run(): void
     {
         // Ambil semua project_timeline_id dan icon_id dari database
         $projectTimelines = ProjectTimeline::pluck('project_timeline_id')->toArray();
         $icons = Icon::pluck('icon_id')->toArray();
 
         // Jika tidak ada data di projectTimelines atau icons, hentikan proses
         if (empty($projectTimelines) || empty($icons)) {
             return;
         }
 
         $descriptions = [
             'Added new feature to dashboard',
             'Fixed bug in authentication system',
             'Updated UI components',
             'Refactored API endpoints',
             'Improved performance of reports',
             'Deployed new version to production',
             'Enhanced security measures',
             'Integrated third-party service',
             'Conducted user testing',
             'Optimized database queries',
         ];
 
         $times = ['09:00', '10:30', '12:45', '14:15', '15:30', '16:45', '18:00', '19:30', '21:00', '22:15'];
 
         $projectTimelineDetails = [];
         foreach ($projectTimelines as $projectTimeline) {
            for ($i = 0; $i < 2; $i++) {
                $projectTimelineDetails[] = [
                    'project_timeline_detail_id' => Str::uuid(),
                    'project_timeline_id' => $projectTimeline,
                    'description' => $descriptions[$i],
                    'time' => $times[$i],
                    'icon_id' => $icons[array_rand($icons)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
    
            // Insert data ke database
            DB::table('project_timeline_details')->insert($projectTimelineDetails);
         }
         
     }
}
