<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;

test('user can delete his post', function () {
    $user = User::factory()->author()->create();
    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->actingAs($user)
        ->delete(route('api:v1:posts:destroy', $post))
        ->assertStatus(204);

    expect(Post::count())->toBe(0);
});

test('admin can delete every post', function () {
    $admin = User::factory()->admin()->create();
    $post = Post::factory()->create();

    $this->actingAs($admin)
        ->delete(route('api:v1:posts:destroy', $post))
        ->assertStatus(204);

    expect(Post::count())->toBe(0);

});
