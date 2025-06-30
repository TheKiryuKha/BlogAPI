<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

test('user(admin) can update category', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->put(
            route('api:v1:categories:update', $category),
            ['title' => 'title']
        )
        ->assertStatus(200);

    expect(Category::count())->toBe(2)
        ->and($category->refresh()->title)->toBe('title');
});

test('user(author) cannot update category', function () {
    $user = User::factory()->author()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->put(
            route('api:v1:categories:update', $category),
            ['title' => 'title']
        )
        ->assertStatus(403);
});

test('user(reader) cannot update category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->put(
            route('api:v1:categories:update', $category),
            ['title' => 'title']
        )
        ->assertStatus(403);
});
