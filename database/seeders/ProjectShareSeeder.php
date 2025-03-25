<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\SocialMedia;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectShareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        
        // Ambil semua project_id dan user_id yang ada
        $projectIds = Project::pluck('project_id')->toArray();
        $userIds    = User::pluck('user_id')->toArray();
        $socialMediaIds = SocialMedia::pluck('social_media_id')->toArray();

        // Jumlah record yang ingin dibuat, misal 50
        for ($i = 0; $i < 50; $i++) {
            DB::table('project_shares')->insert([
                'project_share_id'   => Str::uuid(),
                'project_id'         => $faker->randomElement($projectIds),
                // Gunakan optional sehingga user_id bisa null
                'user_id'            => $faker->optional()->randomElement($userIds),
                'social_media_id'  => $faker->randomElement($socialMediaIds),
                'url'                => $faker->url,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}
