<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Image;
use App\Models\Post;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::inRandomOrder()->limit(15)->pluck('id');
        $users->each(fn($user) => Image::factory()->create(['owner_id' => $user]));

        $posts = Post::inRandomOrder()->limit(150)->pluck('id');
        $posts->each(fn($post) => Image::factory()->post()->create(['owner_id' => $post]));
    }
}
