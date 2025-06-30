<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

test('admin can delete tag', function () {
    $admin = User::factory()->admin()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($admin)
        ->delete(route('api:v1:tags:destroy', $tag))
        ->assertStatus(204);

    expect(Tag::count())->toBe(0);
});

test('author and reader cannot delete tag', function () {
    $tag = Tag::factory()->create();

    $author = User::factory()->author()->create();

    $this->actingAs($author)
        ->delete(route('api:v1:tags:destroy', $tag))
        ->assertStatus(403);

    $reader = User::factory()->create();

    $this->actingAs($reader)
        ->delete(route('api:v1:tags:destroy', $tag))
        ->assertStatus(403);
});
