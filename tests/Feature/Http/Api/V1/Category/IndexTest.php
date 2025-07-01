<?php

declare(strict_types=1);

use App\Models\User;

it('returns the correct code if unauthentitficated', function () {
    $this->getJson(
        route('api:v1:categories:index')
    )->assertStatus(
        401
    );
});

it('returns the correct code if authentitficated', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:categories:index')
    )->assertStatus(
        200
    );
});
