<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Créer le super admin
        $user = User::create([
            'first_name' => 'Rakia ',
            'last_name' => ' Younes',
            'email' => 'rakiayounes@gmail.com',
            'password' => 'rakia123'
        ]);

        // Récupérer le rôle super_admin
        $role = Role::where('name', 'super_admin')->first();

        // Assigner le rôle à l'utilisateur
        $user->assignRole($role);



        // Récupérer les permissions
        $permissions = Permission::whereIn('name', ['add_admin', 'edit_admin', 'delete_admin','restore_admin'])->get();

        // Assigner au rôle
        $role->syncPermissions($permissions);
    }
}
