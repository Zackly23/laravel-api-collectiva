<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::where('project_category', 'donation')->pluck('project_id')->toArray();
        $users = User::pluck('user_id')->toArray();
        $channelPayments = ['bca va', 'bri va', 'gopay', 'shoppe pay'];

        foreach ($projects as $project)  {
            $projectDetails = [];
            for ($i=0; $i <10 ; $i++) { 
                $projectDetails[] = [
                    'project_detail_id' => Str::uuid(),
                    'project_id' => $project,
                    'donatur_id' => $users[array_rand($users)],
                    'donation_amount' =>  fake()->randomFloat(2, 1000, 10000),
                    'description' => fake()->paragraph(1),
                    'channel_payment' => $channelPayments[array_rand($channelPayments)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('project_details')->insert($projectDetails);
        }
    }
}
