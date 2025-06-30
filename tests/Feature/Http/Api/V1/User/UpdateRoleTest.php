<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\User;

test('admin can update users role', function () {
    $user = User::factory()->create();
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('api:v1:users:update', $user), [
            'role' => 'admin',
        ])
        ->assertStatus(200);

    expect($user->refresh()->role)->toBe(UserRole::Admin);
});

test('Non admin cannot update users role', function () {
    $user = User::factory()->create();
    $Nonadmin = User::factory()->create();

    $this->actingAs($Nonadmin)
        ->patch(route('api:v1:users:update', $user), [
            'role' => 'admin',
        ])
        ->assertStatus(403);
});

it('returns the correct status code if unauthenticated', function () {
    $user = User::factory()->create();

    $this->getJson(
        route('api:v1:users:updateRole', $user)
    )->assertStatus(401);
});
