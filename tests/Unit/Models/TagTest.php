<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\Tag;

test('to array', function () {
    $tag = Tag::factory()->create()->fresh();

    expect(array_keys($tag->toArray()))->toBe([
        'id',
        'title',
        'created_at',
        'updated_at',
    ]);
});

it('has posts', function () {
    $tag = Tag::factory()->create();
    $posts = Post::factory(3)->create();

    $tag->posts()->sync($posts);

    expect($tag->posts)->toHaveCount(3)
        ->each->toBeInstanceOf(Post::class);
});
