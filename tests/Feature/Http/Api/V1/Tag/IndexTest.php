<?php

declare(strict_types=1);

use App\Models\User;

it('returns the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:v1:tags:index')
    )->assertStatus(401);
});

it('returns the correct status code if authenticated', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:tags:index')
    )->assertStatus(200);
});
