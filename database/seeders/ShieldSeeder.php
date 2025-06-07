<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_dataset","view_any_dataset","create_dataset","update_dataset","restore_dataset","restore_any_dataset","replicate_dataset","reorder_dataset","delete_dataset","delete_any_dataset","force_delete_dataset","force_delete_any_dataset","view_dataset::tag","view_any_dataset::tag","create_dataset::tag","update_dataset::tag","restore_dataset::tag","restore_any_dataset::tag","replicate_dataset::tag","reorder_dataset::tag","delete_dataset::tag","delete_any_dataset::tag","force_delete_dataset::tag","force_delete_any_dataset::tag","view_organization","view_any_organization","create_organization","update_organization","restore_organization","restore_any_organization","replicate_organization","reorder_organization","delete_organization","delete_any_organization","force_delete_organization","force_delete_any_organization","view_tag","view_any_tag","create_tag","update_tag","restore_tag","restore_any_tag","replicate_tag","reorder_tag","delete_tag","delete_any_tag","force_delete_tag","force_delete_any_tag","view_satuan","view_any_satuan","create_satuan","update_satuan","restore_satuan","restore_any_satuan","replicate_satuan","reorder_satuan","delete_satuan","delete_any_satuan","force_delete_satuan","force_delete_any_satuan","view_ukuran","view_any_ukuran","create_ukuran","update_ukuran","restore_ukuran","restore_any_ukuran","replicate_ukuran","reorder_ukuran","delete_ukuran","delete_any_ukuran","force_delete_ukuran","force_delete_any_ukuran","view_tentang","view_any_tentang","create_tentang","update_tentang","restore_tentang","restore_any_tentang","replicate_tentang","reorder_tentang","delete_tentang","delete_any_tentang","force_delete_tentang","force_delete_any_tentang","page_Themes"]},{"name":"admin_satudata","guard_name":"web","permissions":["view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_dataset","view_any_dataset","create_dataset","update_dataset","restore_dataset","restore_any_dataset","replicate_dataset","reorder_dataset","delete_dataset","delete_any_dataset","force_delete_dataset","force_delete_any_dataset","view_dataset::tag","view_any_dataset::tag","create_dataset::tag","update_dataset::tag","restore_dataset::tag","restore_any_dataset::tag","replicate_dataset::tag","reorder_dataset::tag","delete_dataset::tag","delete_any_dataset::tag","force_delete_dataset::tag","force_delete_any_dataset::tag","view_organization","view_any_organization","create_organization","update_organization","restore_organization","restore_any_organization","replicate_organization","reorder_organization","delete_organization","delete_any_organization","force_delete_organization","force_delete_any_organization","view_tag","view_any_tag","create_tag","update_tag","restore_tag","restore_any_tag","replicate_tag","reorder_tag","delete_tag","delete_any_tag","force_delete_tag","force_delete_any_tag","view_satuan","view_any_satuan","create_satuan","update_satuan","restore_satuan","restore_any_satuan","replicate_satuan","reorder_satuan","delete_satuan","delete_any_satuan","force_delete_satuan","force_delete_any_satuan","view_ukuran","view_any_ukuran","create_ukuran","update_ukuran","restore_ukuran","restore_any_ukuran","replicate_ukuran","reorder_ukuran","delete_ukuran","delete_any_ukuran","force_delete_ukuran","force_delete_any_ukuran","view_tentang","view_any_tentang","create_tentang","update_tentang","restore_tentang","restore_any_tentang","replicate_tentang","reorder_tentang","delete_tentang","delete_any_tentang","force_delete_tentang","force_delete_any_tentang","page_Themes"]},{"name":"admin_opd","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_dataset","view_any_dataset","create_dataset","update_dataset","restore_dataset","restore_any_dataset","replicate_dataset","reorder_dataset","delete_dataset","delete_any_dataset","force_delete_dataset","force_delete_any_dataset","view_dataset::tag","view_any_dataset::tag","create_dataset::tag","update_dataset::tag","restore_dataset::tag","restore_any_dataset::tag","replicate_dataset::tag","reorder_dataset::tag","delete_dataset::tag","delete_any_dataset::tag","force_delete_dataset::tag","force_delete_any_dataset::tag","view_tag","view_any_tag","create_tag","update_tag","restore_tag","restore_any_tag","replicate_tag","reorder_tag","delete_tag","delete_any_tag","force_delete_tag","force_delete_any_tag","view_satuan","view_any_satuan","create_satuan","update_satuan","restore_satuan","restore_any_satuan","replicate_satuan","reorder_satuan","delete_satuan","delete_any_satuan","force_delete_satuan","force_delete_any_satuan","view_ukuran","view_any_ukuran","create_ukuran","update_ukuran","restore_ukuran","restore_any_ukuran","replicate_ukuran","reorder_ukuran","delete_ukuran","delete_any_ukuran","force_delete_ukuran","force_delete_any_ukuran","view_tentang","view_any_tentang","create_tentang","update_tentang","restore_tentang","restore_any_tentang","replicate_tentang","reorder_tentang","delete_tentang","delete_any_tentang","force_delete_tentang","force_delete_any_tentang","page_Themes"]},{"name":"user","guard_name":"web","permissions":[]},{"name":"panel_user","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
