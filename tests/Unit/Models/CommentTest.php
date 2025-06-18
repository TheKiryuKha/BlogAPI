<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

test('to array', function () {
    $comment = Comment::factory()->create()->fresh();

    expect(array_keys($comment->toArray()))->toBe([
        'id',
        'user_id',
        'post_id',
        'text',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to User', function () {
    $comment = Comment::factory()->create();

    expect($comment->user)->toBeInstanceOf(User::class);
});

it('belongs to Post', function () {
    $comment = Comment::factory()->create();

    expect($comment->post)->toBeInstanceOf(Post::class);
});
