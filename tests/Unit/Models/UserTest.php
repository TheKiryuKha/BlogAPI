<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\Post;
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
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ]);
});

it('has posts', function () {
    $user = User::factory()
        ->has(Post::factory()->count(3))
        ->create();

    expect($user->posts)->toHaveCount(3)
        ->each->toBeInstanceOf(Post::class);
});

it('has comments', function () {
    $user = User::factory()
        ->has(Comment::factory()->count(3))
        ->create();

    expect($user->comments)->toHaveCount(3)
        ->each->toBeInstanceOf(Comment::class);
});
