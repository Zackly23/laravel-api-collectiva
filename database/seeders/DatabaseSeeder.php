<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MessageGroupChat;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            WilayahSeeder::class,
            RolePermissionSeeder::class,
            PermissionSeeder::class,
            IconSeeder::class,
            PaymentMethodSeeder::class,
            TagSeeder::class,
            SocialMediaSeeder::class,
            // AgendaSeeder::class,
            // MessageSeeder::class,
            // ProjectSeeder::class,
            // ProjectShareSeeder::class,
            // ProjectCommentSeeder::class,
            // DonationPaymentSeeder::class,
            // VolunteerInvolvementSeeder::class,
            // ProjectEvaluasiSeeder::class,
            // ProjectTimelineSeeder::class,
            // ReportCaseSeeder::class,
            // ProjectTimelineDetailSeeder::class,
            // GroupChatSeeder::class,
            // UserGroupChatSeeder::class,
            // ChatSeeder::class,

            // ProjectTagSeeder::class,

            // MessageGroupChatSeeder::class,
            // MessagePrivateChatSeeder::class,
            // ProjectDetailSeeder::class,
            // VolunteerDetailSeeder::class

        ]);
        
    }
}
