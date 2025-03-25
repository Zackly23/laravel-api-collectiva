<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path file CSV
        $filePath = 'C:\Users\hp\Downloads\kode_wilayah - kode_wilayah.csv';

        // Membuka file CSV
        if (!file_exists($filePath)) {
            $this->command->error("File data_desa.csv tidak ditemukan!");
            return;
        }

        // Membaca file CSV
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file); // Membaca header (baris pertama)
        $i = 0;
        // Iterasi setiap baris data
        while (($row = fgetcsv($file)) !== false) {
            // if ($i > 300) {
            //     break;
            // }
            // Masukkan data ke tabel provinsi
            DB::table('provinsis')->updateOrInsert(
                ['kode_provinsi' => $row[0]],
                ['nama_provinsi' => $row[1]]
            );

            // Masukkan data ke tabel kabupaten
            DB::table('kabupatens')->updateOrInsert(
                ['kode_kabupaten' => $row[2]],
                ['nama_kabupaten' => $row[3],
                'kode_provinsi' => $row[0]]
            );

            // Masukkan data ke tabel kecamatan
            DB::table('kecamatans')->updateOrInsert(
                ['kode_kecamatan' => $row[4]],
                ['nama_kecamatan' => $row[5], 'kode_kabupaten' => $row[2]]
            );

            // Masukkan data ke tabel desa
            DB::table('desas')->updateOrInsert(
                ['kode_desa' => $row[6]],
                ['nama_desa' => $row[7], 'kode_kecamatan' => $row[4]]
            );

            $i++;
        }

        fclose($file); // Tutup file
    }
}
