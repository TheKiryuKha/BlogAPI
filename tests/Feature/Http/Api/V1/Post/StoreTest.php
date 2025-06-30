<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

test('user(admin) can create post', function () {
    $user = User::factory()->admin()->create();
    $category = Category::factory()->create();
    $post = [
        'title' => 'Test',
        'user_id' => $user->id,
        'category_id' => $category->id,
        'status' => 'draft',
        'content' => 'Test',
    ];

    $this->actingAs($user)
        ->post(route('api:v1:posts:store'), $post)
        ->assertStatus(201);

    expect(Post::count())->toBe(1)
        ->and(Post::first()->toArray())->toMatchArray($post);
});

test('user(author) can create post', function () {
    $user = User::factory()->author()->create();
    $category = Category::factory()->create();
    $post = [
        'title' => 'Test',
        'user_id' => $user->id,
        'category_id' => $category->id,
        'status' => 'draft',
        'content' => 'Test',
    ];

    $this->actingAs($user)
        ->post(route('api:v1:posts:store'), $post)
        ->assertStatus(201);

    expect(Post::count())->toBe(1)
        ->and(Post::first()->toArray())->toMatchArray($post);
});

test('user(reader) cannot create post', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $post = [
        'title' => 'Test',
        'user_id' => $user->id,
        'category_id' => $category->id,
        'status' => 'draft',
        'content' => 'Test',
    ];

    $this->actingAs($user)
        ->post(route('api:v1:posts:store'), $post)
        ->assertStatus(403);
});
