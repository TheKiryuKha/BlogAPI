<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

test('to array', function () {
    $tag = Tag::factory()->create()->fresh();

    expect(array_keys($tag->toArray()))->toBe([
        'id',
        'title',
        'user_id',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to User', function () {
    $tag = Tag::factory()
        ->for(User::factory())
        ->create();

    expect($tag->user)->toBeInstanceOf(User::class);
});

it('has posts', function () {
    $tag = Tag::factory()->create();
    $posts = Post::factory(3)->create();

    $tag->posts()->sync($posts);

    expect($tag->posts)->toHaveCount(3)
        ->each->toBeInstanceOf(Post::class);
});
