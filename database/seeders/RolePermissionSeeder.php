<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Path ke file CSV
        $filePath = storage_path('app/private/file/Permission.csv');

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            $this->command->error("File Permission.csv tidak ditemukan!");
            return;
        }

        // Buka file CSV
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file); // Ambil baris pertama sebagai header

        // Ambil nama roles dari header (dimulai dari kolom ke-2)
        $roles = array_slice($header, 1);

        // Log::info('roles : ', [$roles]);

        // Buat roles jika belum ada
        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'uuid' => Str::uuid(),
                'name' => strtolower($roleName)]);
        }

        // Proses setiap baris CSV
        while (($row = fgetcsv($file)) !== false) {
            $permissionName = $row[0]; // Kolom pertama adalah permission
            // Log::info('permission : ', [$permissionName]);
            $permission = Permission::firstOrCreate([
                'uuid' => Str::uuid(),
                'name' => $permissionName]);

            // // Assign permission ke role yang sesuai (1/true/TRUE)
            // foreach ($roles as $index => $roleName) {
            //     if (in_array(strtolower($row[$index + 1]), ['1', 'true', true], true)) {
            //         $role = Role::where('name', strtolower($roleName))->first();
            //         Log::info('role here : ', [$role]);
            //         if ($role) {
            //             $role->givePermissionTo($permission);
            //         }
            //     }
            // }
        }

        fclose($file);
        $this->command->info("Role dan Permission berhasil diimport dari CSV!");

        // Buat Super Admin jika belum ada
        // $superAdmin = User::firstOrCreate(
        //     ['email' => 'superadmin@gmail.com'],
        //     [
        //         'first_name' => 'Super',
        //         'last_name' => 'Admin',
        //         'full_name' => 'Super Admin',
        //         'password' => bcrypt('notaseriousmonster321'),
        //         'email_verified_at' => now(),
        //     ]
        // );

        // // Assign role ke Super Admin
        // if (!$superAdmin->hasRole('admin')) {
        //     $superAdmin->assignRole('admin');
        // }

        // // Cek apakah user admin sudah ada sebelum memberikan role
        // $admin = User::where('email', 'daviddwinugraha2@gmail.com')->first();
        // if ($admin && !$admin->hasRole('admin')) {
        //     $admin->assignRole('admin');
        // }

        $this->command->info("Role dan Permission berhasil diberikan ke Super Admin dan Admin!");
    }
}
