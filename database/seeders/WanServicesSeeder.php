<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class WanServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = FakerFactory::create();

        $services = [
            [
                'service_code' => "SVC" . date('Y') . sprintf("%06d", 1),
                'service_name' => 'Service 1',
                'service_description' => $faker->text(200),
                'service_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => "SVC" . date('Y') . sprintf("%06d", 2),
                'service_name' => 'Service 2',
                'service_description' => $faker->text(200),
                'service_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => "SVC" . date('Y') . sprintf("%06d", 3),
                'service_name' => 'Service 3',
                'service_description' => $faker->text(200),
                'service_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => "SVC" . date('Y') . sprintf("%06d", 4),
                'service_name' => 'Service 4',
                'service_description' => $faker->text(200),
                'service_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => "SVC" . date('Y') . sprintf("%06d", 5),
                'service_name' => 'Service 5',
                'service_description' => $faker->text(200),
                'service_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => "SVC" . date('Y') . sprintf("%06d", 6),
                'service_name' => 'Service 6',
                'service_description' => $faker->text(200),
                'service_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($services as $service) {
            DB::table('wan_services')->insert($service);
        }
    }
}
