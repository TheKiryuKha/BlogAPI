<?php

declare(strict_types=1);

use App\Models\User;

it('returns the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:v1:users:index')
    )->assertStatus(401);
});

it('returns the correct status code if authenticated but not admin', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:users:index')
    )->assertStatus(403);
});

it('returns the correct status code if authenticated and admin', function () {
    $this->actingAs(User::factory()->admin()->create())->getJson(
        route('api:v1:users:index')
    )->assertStatus(200);
});
