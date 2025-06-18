<?php

declare(strict_types=1);

use App\Models\Image;
use App\Models\Post;
use App\Models\User;

test('to array', function () {
    $image = Image::factory()->create()->fresh();

    expect(array_keys($image->toArray()))->toBe([
        'id',
        'path',
        'owner_id',
        'owner_type',
        'created_at',
        'updated_at',
    ]);
});

it('morphTo User', function () {
    $image = Image::factory()
        ->for(User::factory(), 'owner')
        ->create();

    expect($image->owner)->toBeInstanceOf(User::class);
});

it('morphTo Post', function () {
    $image = Image::factory()
        ->for(Post::factory(), 'owner')
        ->create();

    expect($image->owner)->toBeInstanceOf(Post::class);
});
