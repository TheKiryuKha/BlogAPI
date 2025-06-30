<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

test('user(admin) can delete category', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->delete(route('api:v1:categories:destroy', $category))
        ->assertStatus(204);

    // "без категории" уже существуе
    expect(Category::count())->toBe(1);
});

test('user(author) cannot delete category', function () {
    $user = User::factory()->author()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->delete(route('api:v1:categories:destroy', $category))
        ->assertStatus(403);
});

test('user(reader) cannot delete category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->delete(route('api:v1:categories:destroy', $category))
        ->assertStatus(403);
});
