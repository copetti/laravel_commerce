<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder{

    public function run(){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('products')->truncate();

        $faker = Faker::create();

        foreach (range(1,40) as $i){
            Product::create([
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->randomFloat(2, 0.01, 1000),
                'featured' => rand(0,1),
                'recommended' => rand(0,1),
                'category_id' => $faker->numberBetween(1,15)
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}