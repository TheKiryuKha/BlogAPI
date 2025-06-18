<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

test('to array', function () {
    $user = User::factory()->create()->fresh();

    expect(array_keys($user->toArray()))->toBe([
        'id',
        'name',
        'role',
        'description',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
    ]);
});

it('has avatar', function () {
    $user = User::factory()
        ->has(Image::factory(), 'image')
        ->create();

    expect($user->image->count())->toBe(1)
        ->and($user->image)->toBeInstanceOf(Image::class);
});

it('has categories', function () {
    $user = User::factory()
        ->has(Category::factory()->count(3))
        ->create();

    expect($user->categories)->toHaveCount(3);
});

it('has tags', function () {
    $user = User::factory()
        ->has(Tag::factory()->count(3))
        ->create();

    expect($user->tags)->toHaveCount(3);
});

it('has posts', function () {
    $user = User::factory()
        ->has(Post::factory()->count(3))
        ->create();

    expect($user->posts)->toHaveCount(3);
});

it('has comments', function () {
    $user = User::factory()
        ->has(Comment::factory()->count(3))
        ->create();

    expect($user->comments)->toHaveCount(3);
});
