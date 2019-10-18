<?php

use Illuminate\Database\Seeder;

class PasswordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      foreach(range(1, 30) as $key)
      {
        \App\Password::create([
            'title' => $faker->word,
            'fields' => json_encode([
                [
                    'label' => 'Alpha',
                    'value' => 'password'
                ],
                [
                    'label' => 'Beta',
                    'value' => 'password'
                ]
            ]),
            'user_id' => 1,
        ]);
      }
    }
}
