<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'quantity' => $faker->numberBetween(10, 100),
                'price' => $faker->randomFloat(2, 5, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
