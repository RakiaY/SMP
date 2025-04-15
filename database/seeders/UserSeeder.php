<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a super admin role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // Create a user and assign the super_admin role
        $user = User::Create(
            [
                'email' => 'superadmin@gamil.com',
                'first_name' => 'Super',
                'password' => bcrypt('aaaaaaaa'),
                'last_name' => 'Admin'
            ],
        );
        $user->assignRole($role);
        // dd($user);
    }
}
