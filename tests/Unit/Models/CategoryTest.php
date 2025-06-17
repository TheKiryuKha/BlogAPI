<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

test('to array', function () {
    $category = Category::factory()->create()->fresh();

    expect(array_keys($category->toArray()))->toBe([
        'id',
        'title',
        'user_id',
        'created_at',
        'updated_at',
    ]);
});

it('belongs to User', function () {
    $category = Category::factory()
        ->for(User::factory()->author())
        ->create();

    expect($category->user->count())->toBe(1)
        ->and($category->user)->toBeInstanceOf(User::class);
});
