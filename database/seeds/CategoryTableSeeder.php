<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\Category;
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder{

    public function run(){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('categories')->truncate();

        $faker = Faker::create();

        foreach (range(1,15) as $i){

            Category::create([
                'name' => $faker->word(),
                'description' => $faker->sentence()
            ]);

        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}