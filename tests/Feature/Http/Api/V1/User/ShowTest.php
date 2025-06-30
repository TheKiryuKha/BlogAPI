<?php

declare(strict_types=1);

use App\Models\User;

it('returns the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:v1:users:show', User::factory()->create())
    )->assertStatus(401);
});

it('returns the correct status code if authenticated', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->getJson(
        route('api:v1:users:show', $user)
    )->assertStatus(200);
});
