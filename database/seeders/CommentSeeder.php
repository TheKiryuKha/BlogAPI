<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

final class CommentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Post::all() as $post) {
            $commentableUsers = User::inRandomOrder()->limit(random_int(1, 10))->get();

            foreach ($commentableUsers as $user) {
                Comment::factory()->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}
