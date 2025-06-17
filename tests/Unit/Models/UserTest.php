<?php

declare(strict_types=1);

use App\Models\Image;
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
