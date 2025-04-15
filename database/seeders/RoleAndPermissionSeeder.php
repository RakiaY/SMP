<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles and permissions
        $roles = ['Admin', 'User'];
        $permissions = ['view posts', 'edit posts', 'delete posts'];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        foreach ($roles as $role) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);

            // Assign all permissions to the Admin role
            if ($role === 'Admin') {
                $roleInstance->syncPermissions($permissions);
            }
        }
    }
}