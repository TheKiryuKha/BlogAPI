<?php

declare(strict_types=1);

use App\Models\User;

test('user can delete his account', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->delete(route('api:v1:users:destroy', $user))
        ->assertStatus(204);

    expect(User::count())->toBe(0);
});

test('admin can delete users account', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $this->actingAs($admin)
        ->delete(route('api:v1:users:destroy', $user))
        ->assertStatus(204);

    expect(User::count())->toBe(1);
});

test('user cannot delete not his account', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($admin)
        ->delete(route('api:v1:users:destroy', $user))
        ->assertStatus(403);
});

it('returns the correct status code if unauthenticated', function () {
    $user = User::factory()->create();

    $this->getJson(
        route('api:v1:users:destroy', $user)
    )->assertStatus(401);
});
