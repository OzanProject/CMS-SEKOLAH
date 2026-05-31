<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Teacher::create([
                'nip' => $faker->unique()->numberBetween(197000000000000000, 199999999999999999),
                'name' => $faker->name,
                'gender' => $faker->randomElement(['L', 'P']),
            ]);
        }
    }
}
