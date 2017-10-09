<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    $faker = Faker\Factory::create();

    for($i = 0; $i < 10; $i++) {
        App\Answer::create([
            'user_id' => $faker->randomDigitNotNull,
            'Question_id' => $faker->randomDigitNotNull,
            'answers' => $faker->text

            

        ]);
    }
     for($i = 0; $i < 10; $i++) {
        App\Question::create([
            'user_id' => $faker->randomDigitNotNull,
            'title' => $faker->text(60),
            'description' => $faker->text,
            'category_id' => $faker->randomDigitNotNull

            

        ]);
    }

    for($i = 0; $i < 10; $i++) {
        App\User::create([
            'name' => $faker->randomDigitNotNull,
            'username' => $faker->userName,
            'email' => $faker->email,
            'password' => $faker->password,
            'api_key' => $faker->sha1

            

        ]);
    }

    for($i = 0; $i < 10; $i++) {
        App\Category::create([
            'name' => $faker->userName
            

        ]);
    }
}
}
