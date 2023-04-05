<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 20 posts
        for ($i = 1; $i <= 20; $i++) {

            $title = $faker->sentence(6, true);

            Post::create([
                'user_id' => $faker->numberBetween(1, 2),
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $faker->realText($faker->numberBetween(10,200))
            ]);
        }
    }
}