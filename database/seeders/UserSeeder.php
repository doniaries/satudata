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
                    'id_team' => '10', // Super admin tidak terikat ke organisasi tertentu
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
                    'id_team' => '10',
                ]
            );

            // Assign role admin_satudata dengan pengecekan
            if (Role::where('name', 'admin_satudata')->exists()) {
                $adminSatudata->assignRole('admin_satudata');
            } else {
                $this->command->warn('Role admin_satudata tidak ditemukan');
            }

            // Ambil semua organisasi yang ada
            $teams = \App\Models\Team::all();

            // Ambil semua teams
            $teams = \App\Models\Team::get()->values(); // numerik
            // Buat user untuk setiap organisasi dan assign ke team
            foreach ($teams as $idx => $team) {
                // Skip creating user for super_admin's organization if it's null
                if ($team->id === null) {
                    continue;
                }

                $user = User::updateOrCreate(
                    [
                        'email' => 'user_' . $team->slug . '@satudata.id',
                    ],
                    [
                        'name' => 'User ' . $team->name,
                        'password' => Hash::make('password'),
                        'is_active' => true,
                        'id_team' => $team->id,
                    ]
                );

                // Assign role user_satudata jika ada
                if (Role::where('name', 'user_satudata')->exists()) {
                    $user->assignRole('user_satudata');
                } else {
                    $this->command->warn('Role user_satudata tidak ditemukan');
                }

                // Assign user ke team (mapping by urutan)
                $team = $teams->get($idx) ?? $teams->first();
                if ($team) {
                    $user->teams()->syncWithoutDetaching([$team->id]);
                }
            }

            $this->command->info('UserSeeder berhasil dijalankan!');
            $this->command->info('Super Admin: superadmin@gmail.com / @Iamsuperadmin');
        });
    }

    /**
     * Pastikan role-role yang dibutuhkan sudah ada
     */
    private function ensureRolesExist(): void
    {
        $roles = ['super_admin', 'admin_satudata', 'admin_opd'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }
    }
}
