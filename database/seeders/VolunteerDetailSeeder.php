<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VolunteerDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = DB::table('projects')->where('project_category', 'volunteer')->pluck('project_id')->toArray(); // Ambil semua project_id
        $volunteers = DB::table('users')->pluck('user_id')->toArray(); // Ambil semua volunteer_id
        $roles = ['Coordinator', 'Team Member', 'Support Staff', 'Field Volunteer']; // Daftar peran volunteer

        $volunteerDetails = [];

        foreach ($projects as $project) {
            for ($i = 0; $i < 20; $i++) { // Buat 5 volunteer per proyek
                $volunteerDetails[] = [
                    'volunteer_detail_id' => Str::uuid(),
                    'project_id' => $project,
                    'volunteer_id' => $volunteers[array_rand($volunteers)], // Pilih volunteer secara acak
                    'volunteer_role' => $roles[array_rand($roles)], // Pilih peran secara acak
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('volunteer_details')->insert($volunteerDetails); // Masukkan data ke tabel
    }
}

