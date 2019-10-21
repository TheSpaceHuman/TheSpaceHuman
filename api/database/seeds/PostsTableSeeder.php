<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      foreach(range(1, 800) as $key)
      {
        \App\Post::create([
            'title' => $faker->sentence(),
            'body' => $faker->paragraph(20),
            'user_id' => 1,
            'tags' => 'test',
            'image' => $faker->imageUrl(800, 600, 'technics')
        ]);
      }
    }
}
