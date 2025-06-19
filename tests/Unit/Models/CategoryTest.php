<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

test('to array', function () {
    $category = Category::factory()->create()->fresh();

    expect(array_keys($category->toArray()))->toBe([
        'id',
        'title',
        'created_at',
        'updated_at',
    ]);
});

it('has posts', function () {
    $category = Category::factory()
        ->has(Post::factory()->count(3))
        ->create();

    expect($category->posts)->toHaveCount(3)
        ->each->toBeInstanceOf(Post::class);
});
