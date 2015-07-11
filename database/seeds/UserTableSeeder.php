<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder{

    public function run(){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('users')->truncate();

        $faker = Faker::create();

        foreach (range(1,10) as $i){

            User::create([
                'name' => $faker->word(),
                'email' => $faker->email(),
                'password' => Hash::make('1234')
            ]);

        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}