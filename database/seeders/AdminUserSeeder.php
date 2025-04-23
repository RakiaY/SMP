<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
            {
            // Crée le rôle 'admin' s'il n'existe pas
            $role = Role::firstOrCreate(['name' => 'admin']);
    




            // Crée un nouvel utilisateur administrateur
            //$user=User::create([
            /*    'email' => 'admin@example.com',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => 'motdepasse'
            ]);
            // Assigne le rôle 'admin' à l'utilisateur
            $user->assignRole($role);*/
        
        
            
    
            // Crée un nouvel utilisateur administrateur
            $user2 = User::create([
                'email' => 'admin2@example.com',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => 'admin123'
            ]);
            // Assigne le rôle 'admin' à l'utilisateur
            $user2->assignRole($role);
        
    }
}
