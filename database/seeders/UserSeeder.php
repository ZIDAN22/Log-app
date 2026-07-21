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
            'name' => 'Awan',
            'email' => 'Awan21@bllogistik.online',
            'password' => bcrypt('BLLAWAN-20260501'),
            'role' => User::ROLE_MANAGER,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081234567890',
        ]);

            User::create([
            'name' => 'Susfitriah',
            'email' => 'Fitriah002@bllogistik.online',
            'password' => bcrypt('BLLFITRIAH-20260501'),
            'role' => User::ROLE_MANAGER,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Taufik H',
            'email' => 'Taufikhidayat11@bllogistik.online',
            'password' => bcrypt('BLLTAUFIK-20260501'),
            'role' => User::ROLE_ADMIN_OPERASIONAL,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081298765432',
        ]);

        User::create([
            'name' => 'Wisnu',
            'email' => 'mhmdwisnu15@bllogistik.online',
            'password' => bcrypt('BLLWISNU-20260501'),
            'role' => User::ROLE_WAREHOUSE,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081212345678',
        ]);

        User::create([
            'name' => 'Riska',
            'email' => 'Riskarhdtl27@bllogistik.online',
            'password' => bcrypt('BLLRISKA-20260501'),
            'role' => User::ROLE_FINANCE,
            'status' => User::STATUS_ACTIVE,
            'phone' => '081223344556',
        ]);
    }
}
