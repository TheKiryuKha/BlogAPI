<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

test('user can update his post', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);
    $new_post = [
        'title' => 'Test',
        'category_id' => $category->id,
        'status' => 'published',
        'content' => 'Test',
    ];

    $this->actingAs($user)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(200);

    expect($post->refresh()->toArray())->toMatchArray($new_post);
});

test('Nobody can update not his post', function () {
    $post = Post::factory()->create();
    $new_post = [
        'title' => 'Test',
        'category_id' => $post->category_id,
        'status' => 'published',
        'content' => 'Test',
    ];

    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(403);

    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(403);

    $author = User::factory()->author()->create();

    $this->actingAs($author)
        ->put(route('api:v1:posts:update', $post), $new_post)
        ->assertStatus(403);
});
