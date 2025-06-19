<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

final class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Post::all() as $post) {
            $randomTags = Tag::inRandomOrder()
                ->limit(random_int(5, 20))
                ->pluck('id');

            $post->tags()->sync($randomTags);
        }
    }
}
