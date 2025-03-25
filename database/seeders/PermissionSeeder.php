<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Ambil roles dari database
    $adminRole = Role::where('name', 'admin')->first();
    $activeRole = Role::where('name', 'active')->first();
    $verifiedRole = Role::where('name', 'verified')->first();
    $reportedRole = Role::where('name', 'reported')->first();
    $suspendedRole = Role::where('name', 'suspended')->first();

    // Daftar permission berdasarkan CSV
    $permissions = [
        'open-dashboard' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'open-profile' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'edit-profile' => ['admin', 'verified', 'active', 'reported'],
        'edit-setting-preference' => ['admin', 'verified', 'active', 'reported'],
        'edit-setting' => ['admin', 'verified', 'active', 'reported'],
        'open-project' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'open-project-detail' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'edit-project-detail' => ['admin', 'verified', 'active', 'reported'],
        'edit-evaluation-detail' => ['admin', 'verified', 'active', 'reported'],
        'approve-volunteer' => ['admin', 'verified', 'active', 'reported'],
        'upload-supporting-document' => ['admin', 'verified'],
        'update-in-active-project' => ['admin'],
        'withdrawal-donation' => ['admin', 'verified'],
        'delete-project' => ['admin'],
        'create-project' => ['admin', 'verified', 'active'],
        'send-private-chat' => ['admin', 'verified'],
        'send-group-chat' => ['admin', 'verified'],
        'open-private-chat' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'open-group-chat' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'leave-group-chat' => ['admin', 'verified', 'active'],
        'report-user-chat' => ['admin', 'verified', 'active', 'reported'],
        'mute-private-notification' => ['admin', 'verified', 'active', 'reported'],
        'mute-group-notification' => ['admin', 'verified', 'active', 'reported'],
        'open-project-main-detail' => ['admin', 'verified', 'active', 'reported'],
        'download-project-main-document' => ['admin', 'verified', 'active', 'reported'],
        'open-calendar' => ['admin', 'verified', 'active', 'reported', 'suspended'],
        'send-donation' => ['admin', 'verified', 'active'],
        'join-volunteer' => ['admin', 'verified', 'active'],
        'open-management-project' => ['admin'],
        'open-management-account' => ['admin'],
        'store-evaluation-project' => ['admin'],
        'update-review-project' => ['admin'],
        'approve-evaluation' => ['admin'],
        'reject-evaluation' => ['admin'],
        'delete-evaluation' => ['admin'],
        'approve-evaluation-status' => ['admin'],
        'open-modal-withdrawal' => ['admin'],
        'update-withdrawal-status' => ['admin'],
        'upload-transaction-proof' => ['admin'],
        'open-user-detail' => ['admin'],
        'open-suspend-modal' => ['admin'],
        'suspend-user' => ['admin'],
        'delete-account-user' => ['admin'],
    ];
    

    foreach ($permissions as $permissionName => $roles) {
        $permission = Permission::firstOrCreate(['name' => $permissionName]);

        if (in_array('admin', $roles) && $adminRole) {
            $adminRole->givePermissionTo($permission);
        }
        if (in_array('verified', $roles) && $verifiedRole) {
            $verifiedRole->givePermissionTo($permission);
        }
        if (in_array('active', $roles) && $activeRole) {
            $activeRole->givePermissionTo($permission);
        }
        if (in_array('reported', $roles) && $reportedRole) {
            $reportedRole->givePermissionTo($permission);
        }
        if (in_array('suspended', $roles) && $suspendedRole) {
            $suspendedRole->givePermissionTo($permission);
        }
    }


        $otherUsers = User::where('email', '!=', 'daviddwinugraha2@gmail.com')->get();

         //Buat Super Admin jika belum ada
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'full_name' => 'Super Admin',
                'password' => bcrypt('notaseriousmonster321'),
                'email_verified_at' => now(),
                'jenis_kelamin' => 'laki-laki',
            ]
        );

        // Assign role ke Super Admin
        if (!$superAdmin->hasRole('admin')) {
            $superAdmin->assignRole('admin');
        }

        // Cek apakah user admin sudah ada sebelum memberikan role
        $admin = User::where('email', 'daviddwinugraha2@gmail.com')->first();
        if ($admin && !$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        foreach ($otherUsers as $user) {
            if (!$user->hasRole('verified')) { // Cek apakah user belum memiliki role ini
                $user->assignRole('verified');
            }
        }

        $this->command->info("Role dan Permission berhasil di-mapping secara manual!");
    }

}
