<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WanRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        
        $roles = [
            [
                'role_code' => 'admin',
                'role_name' => 'Administrator',
                'role_description' => $faker->text(200),
                'role_status' => 'Active',
            ],
            [
                'role_code' => 'editor',
                'role_name' => 'Editor',
                'role_description' => $faker->text(200),
                'role_status' => 'Active',
            ],
            [
                'role_code' => 'viewer',
                'role_name' => 'Viewer',
                'role_description' => $faker->text(200),
                'role_status' => 'Active',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('wan_roles')->insert($role);
        }
    }
}
