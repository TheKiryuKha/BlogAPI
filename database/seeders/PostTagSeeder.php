<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Post::all() as $post){
            $randomTags = Tag::inRandomOrder()
                ->limit(random_int(5, 20))
                ->pluck('id');


            $post->tags()->sync($randomTags);
        }
    }
}
