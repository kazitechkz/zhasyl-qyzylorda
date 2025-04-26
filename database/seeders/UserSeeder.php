<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'Админ',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => 1
        ]);
        User::create([
           'name' => 'Куратор',
           'email' => 'moder@gmail.com',
           'password' => bcrypt('admin123'),
           'role_id' => 2
        ]);
        User::create([
           'name' => 'Акимат',
           'email' => 'mayor@gmail.com',
           'password' => bcrypt('admin123'),
           'role_id' => 3
        ]);
    }
}
