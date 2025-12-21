<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $positions = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota'];

        for ($i = 0; $i < 8; $i++) {
            \App\Models\Committee::create([
                'name' => $faker->name,
                'gender' => $faker->randomElement(['L', 'P']),
                'position' => $faker->randomElement($positions),
            ]);
        }
    }
}
