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
                    'id_organization' => null, // Super admin tidak terikat ke organisasi tertentu
                ]
            );

            // Assign role dengan pengecekan
            if (Role::where('name', 'super_admin')->exists()) {
                $superAdmin->assignRole('super_admin');
            } else {
                $this->command->warn('Role super_admin tidak ditemukan');
            }

            // Ambil organisasi Dinas Komunikasi dan Informatika
            $kominfo = Organization::where('slug', 'dinas-komunikasi-dan-informatika')->first();

            if ($kominfo) {
                // Data user untuk organisasi Dinas Komunikasi dan Informatika
                $kominfoUsers = [
                    [
                        'name' => 'Admin Kominfo',
                        'email' => 'adminsekrekominfo@gmail.com',
                        'password' => 'password',
                        'role' => 'admin_opd',
                    ],
                    [
                        'name' => 'Admin Bidang TI',
                        'email' => 'adminbidangti@gmail.com',
                        'password' => 'password',
                        'role' => 'admin_opd',
                    ]
                ];

                // Buat user untuk organisasi Kominfo
                foreach ($kominfoUsers as $userData) {
                    $user = User::updateOrCreate(
                        ['email' => $userData['email']],
                        [
                            'name' => $userData['name'],
                            'password' => Hash::make($userData['password']),
                            'id_organization' => $kominfo->id,
                            'is_active' => true,
                        ]
                    );

                    // Assign role dengan pengecekan
                    if (Role::where('name', $userData['role'])->exists()) {
                        $user->assignRole($userData['role']);
                    } else {
                        $this->command->warn("Role {$userData['role']} tidak ditemukan");
                    }
                }
            } else {
                $this->command->warn("Organisasi Dinas Komunikasi dan Informatika tidak ditemukan");
            }

            // Buat sample user untuk beberapa organisasi lain
            $sampleOrganizations = [
                'dinas-kesehatan',
                'dinas-pendidikan-dan-kebudayaan',
                'sekretariat-daerah'
            ];

            foreach ($sampleOrganizations as $orgSlug) {
                $organization = Organization::where('slug', $orgSlug)->first();
                if ($organization) {
                    $user = User::updateOrCreate(
                        ['email' => "admin@{$orgSlug}.go.id"],
                        [
                            'name' => "Admin {$organization->name}",
                            'password' => Hash::make('password'),
                            'id_organization' => $organization->id,
                            'is_active' => true,
                        ]
                    );

                    if (Role::where('name', 'admin_opd')->exists()) {
                        $user->assignRole('admin_opd');
                    }
                }
            }

            $this->command->info('UserSeeder berhasil dijalankan!');
            // $this->command->info('Super Admin: superadmin@gmail.com / @Iamsuperadmin');
            // $this->command->info('Admin Kominfo: adminsekrekominfo@gmail.com / password');
            // $this->command->info('Admin Bidang TI: adminbidangti@gmail.com / password');
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
