<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class WanPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = FakerFactory::create();

        for ($i = 0; $i < 30; $i++) {
            $position = [
                'service_id' => rand(1, 6), 
                'pos_code' => "POS" . date('Y') . uniqid(),
                'pos_name' => $faker->unique()->jobTitle,
                'pos_description' => $faker->optional()->paragraph, 
                'pos_status' => $faker->randomElement(['Active', 'Inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('wan_positions')->insert($position);
        }

    }
}
