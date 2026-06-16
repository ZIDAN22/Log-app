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
            'name' => 'Manager Logistik',
            'email' => '1@123.id',
            'password' => bcrypt('pasword123'),
            'role' => User::ROLE_MANAGER,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Admin Operasional',
            'email' => 'operasional@logistik.id',
            'password' => bcrypt('password123'),
            'role' => User::ROLE_ADMIN_OPERASIONAL,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081298765432',
        ]);

        User::create([
            'name' => 'Staff Warehouse',
            'email' => 'warehouse@logistik.id',
            'password' => bcrypt('password123'),
            'role' => User::ROLE_WAREHOUSE,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081212345678',
        ]);

        User::create([
            'name' => 'Finance',
            'email' => 'finance@logistik.id',
            'password' => bcrypt('password123'),
            'role' => User::ROLE_FINANCE,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081223344556',
        ]);
    }
}
