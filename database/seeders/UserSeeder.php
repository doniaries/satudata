<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Pastikan role sudah ada, jika belum buat
            $this->ensureRolesExist();

            // Buat super admin
            $superAdmin = User::updateOrCreate(
                ['email' => 'superadmin@gmail.com'],
                [
                    'name' => 'Super Admin',
                    'password' => Hash::make('@Iamsuperadmin'),
                    'is_active' => true,
                    'id_organization' => '10', // Super admin tidak terikat ke organisasi tertentu
                ]
            );

            // Assign role dengan pengecekan
            if (Role::where('name', 'super_admin')->exists()) {
                $superAdmin->assignRole('super_admin');
            } else {
                $this->command->warn('Role super_admin tidak ditemukan');
            }

            $adminSatudata = User::updateOrCreate(
                ['email' => 'admin@satudata.id'],
                [
                    'name' => 'Admin Satudata',
                    'password' => Hash::make('password'),
                    'is_active' => true,
                    'id_organization' => '10',
                ]
            );

            // Assign role admin_satudata dengan pengecekan
            if (Role::where('name', 'admin_satudata')->exists()) {
                $adminSatudata->assignRole('admin_satudata');
            } else {
                $this->command->warn('Role admin_satudata tidak ditemukan');
            }

            // Ambil semua organisasi yang ada
            $organizations = Organization::all();

            // Buat user untuk setiap organisasi
            foreach ($organizations as $organization) {
                // Skip creating user for super_admin's organization if it's null
                if ($organization->id === null) {
                    continue;
                }

                $emailSlug = str_replace('-', '', $organization->slug);
                $email = "admin{$emailSlug}@sijunjung.go.id";

                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => "Admin {$organization->name}",
                        'password' => Hash::make('password'), // Password default
                        'id_organization' => $organization->id,
                        'is_active' => true,
                    ]
                );

                // Assign role admin_opd dengan pengecekan
                if (Role::where('name', 'admin_opd')->exists()) {
                    $user->assignRole('admin_opd');
                } else {
                    $this->command->warn("Role admin_opd tidak ditemukan");
                }
            }

            $this->command->info('UserSeeder berhasil dijalankan!');
            $this->command->info('Super Admin: superadmin@gmail.com / @Iamsuperadmin');
            $this->command->info('Sample Admin OPD: admin[organizationslug]@sijunjung.go.id / password');
        });
    }

    /**
     * Pastikan role-role yang dibutuhkan sudah ada
     */
    private function ensureRolesExist(): void
    {
        $roles = ['super_admin', 'admin_opd', 'user'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }
    }
}
