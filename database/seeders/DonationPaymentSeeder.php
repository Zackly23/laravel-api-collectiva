<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\DonationTransactionStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DonationPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {   
        $faker = \Faker\Factory::create();

        // Ambil ID proyek dari tabel projects
        $projectIds = Project::where('project_category', 'donation')->pluck('project_id')->toArray();
        // Ambil ID donatur (diasumsikan dari tabel users)
        $donaturs = User::select('user_id', 'email', 'full_name', 'address')->get();
        $paymentMethods = PaymentMethod::select('payment_method_id', 'payment_type', 'payment_name')->get();
        // $paymentMethodName = PaymentMethod::pluck('payment_name')->toArray();

        // Contoh channel payment dan status
        // $channelPayments = ['transfer', 'e-wallet', 'credit_card'];
        $statuses = DonationTransactionStatusEnum::values();

        // Misal, buat 10 record donation payment
        foreach ($projectIds as $projectId) {
            for ($i = 0; $i < 10; $i++) {

                $donatur = $donaturs->random();
                $paymentMethod = $paymentMethods->random();

                                // Buat tanggal acak untuk created_at antara 5 tahun yang lalu hingga sekarang
                $createdAt = $faker->dateTimeBetween('-5 years', 'now');
                // Buat updated_at yang acak antara created_at dan sekarang
                $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

                DB::table('donation_payments')->insert([
                    'donation_payment_id' => Str::uuid(),
                    'donation_code'       => strtoupper(Str::random(6)), // kode donasi acak, misalnya "ABCD12"
                    'project_id'          => $projectId,
                    'donatur_id'          => $donatur->user_id,
                    'email'                    => $donatur->email ?? 'volunteer' . $i . '@example.com',
                    'full_name'                => $donatur->full_name ?? 'Volunteer ' . $i,
                    'address'                  => $donatur->address ?? 'Jl. Contoh No. ' . rand(1, 100),
                    'phone_number'             => '0812' . rand(10000000, 99999999),
                    'donation_amount'     => rand(100, 10000) + (rand(0, 99) / 100), // contoh nilai donasi: 5000.75
                    'channel_payment'     => $paymentMethod->payment_type,
                    'channel_name'          => $paymentMethod->payment_name,
                    'payment_method_id'   => $paymentMethod->payment_method_id,
                    // 'account_number'      => (string)rand(10000000, 99999999), // nomor rekening acak
                    'status'              => $statuses[array_rand($statuses)],
                    'created_at'          => $createdAt,
                    'updated_at'          => $updatedAt
                ]);
            }        }

    }
}
