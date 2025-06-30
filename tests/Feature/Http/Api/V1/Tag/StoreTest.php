<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

test('user(author) can create tag', function () {
    $user = User::factory()->author()->create();

    $this->actingAs($user)
        ->post(route('api:v1:tags:store'), ['title' => 'test'])
        ->assertStatus(201);

    expect(Tag::count())->toBe(1)
        ->and(Tag::first()->title)->toBe('test');
});

test('user(admin) can create tag', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->post(route('api:v1:tags:store'), ['title' => 'test'])
        ->assertStatus(201);

    expect(Tag::count())->toBe(1)
        ->and(Tag::first()->title)->toBe('test');
});

test('user(reader) cannot create tag', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('api:v1:tags:store'), ['title' => 'test'])
        ->assertStatus(403);
});
