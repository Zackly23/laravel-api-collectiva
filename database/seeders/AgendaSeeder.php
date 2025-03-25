<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Agenda::create([
            'date' => '2025-01-16',
            'is_completed' => true,
            'description' => 'Meeting with the project team',
            'color' => 'blue'
        ]);

        Agenda::create([
            'date' => '2025-01-16',
            'is_completed' => true,
            'description' => 'Meeting with Presiden',
            'color' => 'red'
        ]);

        Agenda::create([
            'date' => '2025-01-17',
            'is_completed' => false,
            'description' => 'Working Out',
            'color' => 'blue'
        ]);

        Agenda::create([
            'date' => '2025-01-16',
            'is_completed' => true,
            'description' => 'Meeting with the team',
            'color' => 'green'
        ]);

        Agenda::create([
            'date' => '2025-01-18',
            'is_completed' => true,
            'description' => 'Deadline of Working Programming',
            'color' => 'aliceblue'
        ]);

        Agenda::create([
            'date' => '2025-01-19',
            'is_completed' => false,
            'description' => 'Summer Vacation',
            'color' => 'aqua'
        ]);
    }
}
