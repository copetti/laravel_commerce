<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Product;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder{

    public function run(){

        DB::table('products')->truncate();

        $faker = Faker::create();

        foreach (range(1,15) as $i){
            Product::create([
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->numberBetween($min = 100, $max = 1000),
                'featured' => rand(0,1),
                'recommended' => rand(0,1)
            ]);
        }


    }
}