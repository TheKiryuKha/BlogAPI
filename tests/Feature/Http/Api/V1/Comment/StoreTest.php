<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

test('user can write comment', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->actingAs($user)
        ->post(route('api:v1:comments:store'), [
            'post_id' => $post->id,
            'text' => 'Nice Post',
        ])
        ->assertStatus(201);

    expect(Comment::count())->toBe(1)
        ->and(Comment::first())
        ->post_id->toBe($post->id)
        ->user_id->toBe($user->id)
        ->text->toBe('Nice Post');
});
