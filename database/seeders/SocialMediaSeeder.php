<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('social_medias')->insert([
            [
                'social_media_id'   => Str::uuid(),
                'social_media_name' => 'Facebook',
                'icon'              => 'ui uil-facebook-f', // atau path icon, misal 'images/icons/facebook.png'
                'background_color'  => '#1877F2',
                'hover_color'       => '#1558B0',
                'label'             => 'Share on Facebook',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'social_media_id'   => Str::uuid(),

                'social_media_name'  => 'Twitter',
                'icon'              => 'ui uil-twitter',
                'background_color'  => '#1DA1F2',
                'hover_color'       => '#1DA1F5',
                'label'             => 'Share on Twitter',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'social_media_id'   => Str::uuid(),

                'social_media_name'       => 'Instagram',
                'icon'              => 'ui uil-instagram',
                'background_color'  => '#E4405F',
                'hover_color'       => ' #C13553',
                'label'             => 'Share on Instagram',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'social_media_id'   => Str::uuid(),

                'social_media_name'       => 'LinkedIn',
                'icon'              => 'ui uil-linkedin',
                'background_color'  => '#0A66C2',
                'hover_color'       => ' #004182',
                'label'             => 'Share on LinkedIn',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            
        ]);
    }
}
