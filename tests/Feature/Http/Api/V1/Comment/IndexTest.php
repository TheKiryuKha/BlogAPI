<?php

declare(strict_types=1);

use App\Models\User;

it('returns the correct code if unauthentitficated', function () {
    $this->getJson(
        route('api:v1:comments:index')
    )->assertStatus(
        401
    );
});

it('returns the correct code if authentitficated bun ton admin', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:comments:index')
    )->assertStatus(
        403
    );
});

it('returns the correct code if authentitficated and admin', function () {
    $this->actingAs(User::factory()->admin()->create())->getJson(
        route('api:v1:comments:index')
    )->assertStatus(
        200
    );
});
