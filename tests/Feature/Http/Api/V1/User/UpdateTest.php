<?php

declare(strict_types=1);

use App\Models\User;

test('user can update his profile information', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('api:v1:users:update', $user), [
            'description' => 'Test',
            'name' => 'test',
        ])
        ->assertStatus(200);

    expect($user->refresh())
        ->description->toBe('Test')
        ->name->toBe('test');
});

test('only user can update his profile information', function () {
    $user = User::factory()->create();
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->put(route('api:v1:users:update', $user), [
            'description' => 'Test',
            'name' => 'test',
        ])
        ->assertStatus(403);
});

it('returns the correct status code if unauthenticated', function () {
    $user = User::factory()->create();
    
    $this->getJson(
        route('api:v1:users:show', $user)
    )->assertStatus(401);
});
