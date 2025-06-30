<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

test('user(author) can create tag', function () {
    $user = User::factory()->author()->create();
    $tags = [
        ['title' => 'test1'],
        ['title' => 'test2'],
        ['title' => 'test3'],
    ];

    $this->actingAs($user)
        ->post(route('api:v1:tags:bulkStore'), $tags)
        ->assertStatus(201);

    expect(Tag::count())->toBe(3);
});

test('user(admin) can create tag', function () {
    $user = User::factory()->admin()->create();
    $tags = [
        ['title' => 'test1'],
        ['title' => 'test2'],
        ['title' => 'test3'],
    ];

    $this->actingAs($user)
        ->post(route('api:v1:tags:bulkStore'), $tags)
        ->assertStatus(201);

    expect(Tag::count())->toBe(3);
});

test('user(reader) cannot create tag', function () {
    $user = User::factory()->create();
    $tags = [
        ['title' => 'test1'],
        ['title' => 'test2'],
        ['title' => 'test3'],
    ];

    $this->actingAs($user)
        ->post(route('api:v1:tags:bulkStore'), $tags)
        ->assertStatus(403);
});
