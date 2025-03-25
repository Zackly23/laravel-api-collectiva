<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
        public function run()
    {
        // Ambil semua project_id dari Project
        $projectIds = Project::pluck('project_id')->toArray();
        
        // Ambil semua user_id dari User
        $userIds = User::pluck('user_id')->toArray();

        // Pastikan ada data dalam tabel Project & User sebelum seeding
        if (empty($projectIds) || count($userIds) < 2) {
            return; // Hindari error jika tidak ada cukup data
        }

        // Jenis laporan yang akan digunakan secara acak
        $reportCases = [
            'Spam' => 'User ini sering mengirim spam di proyek.',
            'Harassment' => 'Pengguna mengirimkan pesan yang tidak pantas.',
            'Fake Profile' => 'Akun ini diduga menggunakan identitas palsu.',
            'Plagiarism' => 'Konten yang dibuat mencurigakan sebagai hasil plagiarisme.',
        ];

        // Menyimpan semua data untuk batch insert
        $reportData = [];

        foreach ($projectIds as $index => $projectId) {
            for ($i = 0; $i < 4; $i++) { // 4 laporan per proyek
                $reportType = array_rand($reportCases); // Ambil jenis laporan secara acak

                $reportData[] = [
                    'report_case_id'    => Str::uuid(),
                    'reporter_id'       => $userIds[array_rand($userIds)], // Pilih user secara acak
                    'reported_id'       => $userIds[array_rand($userIds)], // Pilih user secara acak
                    'project_id'        => $projectId,
                    'reported_case'     => $reportType,
                    'reported_comment'  => $reportCases[$reportType],
                    'reported_path_file'=> 'uploads/reports/' . Str::random(10) . '.jpg',
                    'reported_segment'  => 'comment_section',
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ];
            }
            if($index == 0 ) {
                continue;
            }
        }

        // Insert semua data dalam satu query untuk efisiensi
        DB::table('report_cases')->insert($reportData);
    
    }
}
