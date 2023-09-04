<?php

namespace Database\Seeders;

use App\Commons\Enums\RoleEnum;
use App\Helper\Helper;
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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'phone_number' => '1234567890',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole(Helper::getRoleModels(RoleEnum::ADMIN));

        $report = User::create([
                'name' => 'Test',
                'email' => 'test@gmail.com',
                'username' => 'test',
                'phone_number' => '12345678900',
                'password' => bcrypt('password'),
        ]);

        $report->assignRole(Helper::getRoleModels(RoleEnum::REPORTER));
    }
}
