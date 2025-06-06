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
        $user = User::Create(
            [
                'email' => 'oumeya@gmail.com',
                'first_name' => 'oumeya',
                'password' => 'oumeya123',
                'last_name' => 'maiz'
            ],
        );
    }
}
