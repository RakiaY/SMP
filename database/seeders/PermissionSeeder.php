<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'add_admin']);
        Permission::firstOrCreate(['name' => 'edit_admin']);
        Permission::firstOrCreate(['name' => 'delete_admin']);
        Permission::firstOrCreate(['name' => 'restore_admin']);

    }
}
