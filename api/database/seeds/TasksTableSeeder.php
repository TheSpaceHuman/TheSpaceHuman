<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
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
        \App\Task::create([
            'title' => $faker->word,
            'body' => $faker->text(400),
            'user_id' => 1,
            'end' => $faker->dateTimeBetween('now', '+10 days', 'Europe/Moscow')
        ]);
      }
    }
}
