<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

test('to array', function () {
    $post = Post::factory()->create()->fresh();

    expect(array_keys($post->toArray()))->toBe([
        'id',
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'status',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to User', function () {
    $post = Post::factory()->create();

    expect($post->user)->toBeInstanceOf(User::class);
});

it('belongs to Category', function () {
    $post = Post::factory()->create();

    expect($post->category)->toBeInstanceOf(Category::class);
});

it('has Comments', function () {
    $post = Post::factory()
        ->has(Comment::factory()->count(3))
        ->create();

    expect($post->comments)->toHaveCount(3)
        ->each->toBeInstanceOf(Comment::class);
});

it('has tags', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->tags()->sync($tags);

    expect($post->tags)->toHaveCount(3)
        ->each->toBeInstanceOf(Tag::class);
});
