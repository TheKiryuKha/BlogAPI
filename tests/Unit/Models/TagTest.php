<?php

declare(strict_types=1);

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

    expect($tag->user->count())->toBe(1)
        ->and($tag->user)->toBeInstanceOf(User::class);
});
