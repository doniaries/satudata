<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminSatudata = Role::firstOrCreate(['name' => 'admin_satudata', 'guard_name' => 'web']);
        $adminOpd = Role::firstOrCreate(['name' => 'admin_opd', 'guard_name' => 'web']);
        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Get all permissions
        $permissions = Permission::all();

        // Assign all permissions to super_admin and admin_satudata
        $superAdmin->syncPermissions($permissions);
        $adminSatudata->syncPermissions($permissions);

        // Assign all permissions except for organization and user to admin_opd
        $adminOpdPermissions = $permissions->filter(function ($permission) {
            return !str_contains($permission->name, 'organization') &&
                   !str_contains($permission->name, 'user');
        });
        $adminOpd->syncPermissions($adminOpdPermissions);

        // Assign basic permissions to user
        $userPermissions = $permissions->filter(function ($permission) {
            return (str_contains($permission->name, 'view_') ||
                str_contains($permission->name, 'task')) &&
                !str_contains($permission->name, 'user') &&
                !str_contains($permission->name, 'role') &&
                !str_contains($permission->name, 'permission');
        });
        $user->syncPermissions($userPermissions);

        // Reset cache again
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
