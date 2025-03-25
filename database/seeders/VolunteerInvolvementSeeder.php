<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Enums\VolunteerStatusEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VolunteerInvolvementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil ID proyek dari tabel projects
        $projectIds = Project::where('project_category', 'volunteer')->pluck('project_id')->toArray();
        // Ambil ID volunteer dari tabel users
        $volunteers = User::select('user_id', 'email', 'full_name')->get();

        // Contoh role dan status yang akan digunakan
        $roles = ['Coordinator', 'Member', 'Support'];
        $statuses = VolunteerStatusEnum::values();

        foreach ($projectIds as $projectId) {
            for ($i = 0; $i < 10; $i++) {
                // Ambil data volunteer secara acak
                $volunteer = $volunteers->random();
                
                DB::table('volunteer_involvements')->insert([
                    'volunteer_involvement_id' => Str::uuid(),
                    'project_id'               => $projectId,
                    'volunteer_id'             => $volunteer->user_id,
                    'email'                    => $volunteer->email ?? 'volunteer' . $i . '@example.com',
                    'full_name'                => $volunteer->name ?? 'Volunteer ' . $i,
                    'address'                  => 'Jl. Contoh No. ' . rand(1, 100),
                    'phone_number'             => '0812' . rand(10000000, 99999999),
                    'criteria_checked'         => json_encode([
                        ['key' => 'Skill A', 'value' => 'Intermediate', 'role' => 'Member', 'checked' => true],
                        ['key' => 'Skill B', 'value' => 'Beginner', 'role' => 'Member', 'checked' => false],
                    ]),
                    'volunteer_hours'          => rand(1, 40) + (rand(0, 99) / 100), // contoh: 10.75 jam
                    'involvement_start_date'   => Carbon::now()->subDays(rand(0, 30))->toDateString(),
                    'involvement_end_date'     => Carbon::now()->subDays(rand(0, 30))->addDays(3)->toDateString(),
                    'involvement_start_time'   => '08:00',
                    'involvement_end_time'     => '16:00',
                    'role'                     => $roles[array_rand($roles)],
                    'status'                   => $statuses[array_rand($statuses)],
                    'note'                     => 'Catatan tambahan',
                    'created_at'               => Carbon::now(),
                    'updated_at'               => Carbon::now(),
                ]);
            }
        }
    }
}
