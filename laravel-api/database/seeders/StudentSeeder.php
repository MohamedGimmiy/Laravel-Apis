<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        DB::table('students')->insert([
            'name' => $faker->name(),
            'email' => $faker->email(),
            'age' => $faker->numberBetween(25,45),
            'gender' => $faker->randomElement([
                'male', 'female'
            ]),
            'phone_no' => $faker->phoneNumber()
        ])
    }
}
