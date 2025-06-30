<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\User;

test('user can update his comment', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->actingAs($user)
        ->patch(route('api:v1:comments:update', $comment), [
            'text' => 'new Text',
        ])
        ->assertStatus(200);

    expect($comment->refresh()->text)->toBe('new Text');
})->only();

test('Nobody can update not his comment', function () {
    $user = User::factory()->create();
    $admin = User::factory()->admin()->create();
    $author = User::factory()->author()->create();
    $comment = Comment::factory()->create();

    $this->actingAs($user)
        ->patch(route('api:v1:comments:update', $comment), [
            'text' => 'new Text',
        ])
        ->assertStatus(403);

    $this->actingAs($admin)
        ->patch(route('api:v1:comments:update', $comment), [
            'text' => 'new Text',
        ])
        ->assertStatus(403);

    $this->actingAs($author)
        ->patch(route('api:v1:comments:update', $comment), [
            'text' => 'new Text',
        ])
        ->assertStatus(403);
})->only();
