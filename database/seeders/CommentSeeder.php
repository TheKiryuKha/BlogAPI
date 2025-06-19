<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        foreach(Post::all() as $post){
            $commentableUsers = User::inRandomOrder()->limit(rand(1, 10))->get();
            
            foreach($commentableUsers as $user){
                Comment::factory()->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id
                ]);
            }
        }
    }
}
