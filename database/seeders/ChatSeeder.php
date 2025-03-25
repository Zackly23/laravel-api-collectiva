<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['text', 'image', 'video', 'document'];

        // Seed 10 data chat
        for ($i = 0; $i < 20; $i++) {
            DB::table('chats')->insert([
                'chat_id' => Str::uuid(),
                'chat_text' => fake()->sentence(), // Menggunakan faker untuk teks acak
                'sent_at' => Carbon::now()->subMinutes(rand(1, 1000)), // Waktu acak
                'category' => $categories[array_rand($categories)], // Pilih kategori acak
                'media_path' => fake()->optional()->imageUrl(), // Jalur media opsional
                'created_at' => Carbon::now()->addDay($i),
                'updated_at' => Carbon::now()->addDay($i)
            ]);
        }
    }
}
