<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

test('admin can update tag', function () {
    $admin = User::factory()->admin()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($admin)
        ->put(route('api:v1:tags:update', $tag), [
            'title' => 'test',
        ])
        ->assertStatus(200);

    expect($tag->refresh()->title)->toBe('test');
});

test('reader and author cannot update tag', function () {
    $tag = Tag::factory()->create();

    $author = User::factory()->author()->create();

    $this->actingAs($author)
        ->put(route('api:v1:tags:update', $tag), [
            'title' => 'test',
        ])
        ->assertStatus(403);

    $reader = User::factory()->create();

    $this->actingAs($reader)
        ->put(route('api:v1:tags:update', $tag), [
            'title' => 'test',
        ])
        ->assertStatus(403);
});
