<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'admin' => [
                'admin_view',
                'admin_create',
                'admin_edit',
                'admin_update_status',
            ],
            'role' => [
                'role_view',
                'role_create',
                'role_edit',
                'role_update_permission',
            ],
        ];

        foreach ($permissions as $key => $permission) {
            foreach ($permission as $p) {
                $record = Permission::where('name', $p)->first();
                if (!$record) {
                    Permission::create([
                        'group_name' => $key,
                        'name' => $p,
                        'guard_name' => 'admin',
                    ]);
                }
            }
        }

        $permissions = Permission::where('guard_name', 'admin')->get();
        $tech_role = Role::where('name', 'Technical')->first();
        if (!$tech_role) {
            $tech_role = Role::create([
                'name' => 'Technical',
                'guard_name' => 'admin',
            ]);
        }
        $role = Role::where('name', 'Super Admin')->first();
        if (!$role) {
            $role = Role::create([
                'name' => 'Super Admin',
                'guard_name' => 'admin',
            ]);
        }

        foreach ($permissions as $p) {
            $role_permission = DB::table('role_has_permissions')->where('role_id', $tech_role->id)->where('permission_id', $p->id)->first();
            if (!empty($role_permission)) continue;
            DB::table('role_has_permissions')->insert([
                [
                    'role_id'         => $tech_role->id,
                    'permission_id'   => $p->id,
                ],
            ]);
        }

        foreach ($permissions as $p) {
            $role_permission = DB::table('role_has_permissions')->where('role_id', $role->id)->where('permission_id', $p->id)->first();
            if (!empty($role_permission)) continue;
            DB::table('role_has_permissions')->insert([
                [
                    'role_id'         => $role->id,
                    'permission_id'   => $p->id,
                ],
            ]);
        }

        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Models\Admin',
                'model_id' => 1068,
            ],[
                'role_id' => 2,
                'model_type' => 'App\Models\Admin',
                'model_id' => 1069,
            ],
        ]);
    }
}
