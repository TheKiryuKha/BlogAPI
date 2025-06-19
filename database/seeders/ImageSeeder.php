<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

final class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::inRandomOrder()->limit(15)->pluck('id');
        $users->each(fn ($user) => Image::factory()->create(['owner_id' => $user]));

        $posts = Post::inRandomOrder()->limit(150)->pluck('id');
        $posts->each(fn ($post) => Image::factory()->post()->create(['owner_id' => $post]));
    }
}
