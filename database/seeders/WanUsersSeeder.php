<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WanUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('fr_FR'); // Creates faker instance with french locale

        for ($i = 0; $i < 100; $i++) {
            $user = [
                'matricule' => "MAT".date('Y').$faker->unique()->randomNumber(8),
                'parent_id' => null,
                'role_id' => rand(1, 3), // Assuming roles_id has values between 1 and 3
                'position_id' => rand(1, 30), // Assuming roles_id has values between 1 and 6
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'date_of_birth' => $faker->date('Y-m-d', '-25 years'),
                'phone_number' => $faker->unique()->phoneNumber,
                'numero_cni' => $faker->unique()->numerify('CNI############'),
                'username' => $faker->unique()->userName,
                'password' => Hash::make('1111'), // Replace with your desired default password
                'address' => $faker->streetAddress,
                'ville' => $faker->city,
                'country' => $faker->country,
                'sexe' => $faker->randomElement(['male', 'female']),
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'slug' => Str::random(100), // Use Laravel's Str class for slug generation
                'account_status' => $faker->randomElement(['Active', 'Inactive', 'Delete']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert the user data into the database
            DB::table('wan_users')->insert($user);
        }
    }
}
