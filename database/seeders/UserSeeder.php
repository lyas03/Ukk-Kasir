<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        User::create([
            'nama' => 'Kasir',
            'username' => 'kasir',
            'password' => bcrypt('kasir'),
            'role' => 'kasir',
        ]);
        User::create([
            'nama' => 'Owner',
            'username' => 'owner',
            'password' => bcrypt('owner'),
            'role' => 'owner',
        ]);
    }
}
