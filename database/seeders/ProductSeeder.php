<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'category_id' => $faker->biasedNumberBetween(1, 4),
                'name' => $faker->name(),
                'description' => $faker->realText(100),
                'image' => 'default.jpg',
                'purchase_price' => $faker->randomFloat(2, 10, 1000),
                'sale_price' => $faker->randomFloat(2, 10, 1000),
                'stock' => $faker->randomNumber(3)
            ]);
        }
    }
}
