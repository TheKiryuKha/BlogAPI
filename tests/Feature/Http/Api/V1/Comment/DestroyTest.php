<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\User;

test('user(reader) can delete his own comment', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->actingAs($user)
        ->delete(route('api:v1:comments:destroy', $comment))
        ->assertStatus(204);

    expect(Comment::count())->toBe(0);
});

test('user(author) can delete his own comment', function () {
    $user = User::factory()->author()->create();
    $comment = Comment::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->actingAs($user)
        ->delete(route('api:v1:comments:destroy', $comment))
        ->assertStatus(204);

    expect(Comment::count())->toBe(0);
});

test('user(admin) can delete his own comment', function () {
    $user = User::factory()->admin()->create();
    $comment = Comment::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->actingAs($user)
        ->delete(route('api:v1:comments:destroy', $comment))
        ->assertStatus(204);

    expect(Comment::count())->toBe(0);
});

test('user(admin) can delete every comment', function () {
    $admin = User::factory()->admin()->create();

    $readers_comment = Comment::factory()
        ->for(User::factory())
        ->create();

    $authors_comment = Comment::factory()
        ->for(User::factory()->author())
        ->create();

    $this->actingAs($admin)
        ->delete(route('api:v1:comments:destroy', $readers_comment))
        ->assertStatus(204);

    $this->actingAs($admin)
        ->delete(route('api:v1:comments:destroy', $authors_comment))
        ->assertStatus(204);

    expect(Comment::count())->toBe(0);
});
