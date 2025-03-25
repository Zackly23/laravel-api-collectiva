<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Enums\ProjectStatusEnum;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = User::pluck('user_id')->toArray();
        $categories = ['donation', 'volunteer'];
        $kode_desa = Desa::pluck('kode_desa')->toArray();
        $now = Carbon::now();
        $statuses = ProjectStatusEnum::values();
        
        for ($i = 0; $i < 25; $i++) {
            $category = $categories[array_rand($categories)];
            $status = $faker->randomElement($statuses);
            $target_amount = ($category === 'volunteer') 
                ? $faker->numberBetween(1, 1000) 
                : $faker->randomFloat(2, 1000, 1000000);

            DB::table('projects')->insert([
                'project_id' => Str::uuid(),
                'project_title' => $faker->sentence(3),
                'project_description' => $faker->paragraph,
                'project_start_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'project_end_date' => $faker->dateTimeBetween('now', '+1 year'),
                'project_target_amount' => $target_amount,
                'creator_id' => $users[array_rand($users)],
                'project_status' => $status,
                'project_category' => $category,
                'project_criteria' => null,
                'project_address' => $faker->address,
                'kode_desa' => $kode_desa[array_rand($kode_desa)],
                'latitude' => $faker->latitude(-90, 90), // Latitude dengan rentang valid
                'longitude' => $faker->longitude(-180, 180), // Longitude dengan rentang valid
                'completed_at' => $status == 'completed' ? $now->subDay(7) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
