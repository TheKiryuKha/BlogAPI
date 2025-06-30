<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

beforeEach(fn () => $this->tag = Tag::factory()->create());

it('returns the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:v1:tags:show')
    )->assertStatus(401);
});

it('returns the correct status code if authenticated', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:tags:index')
    )->assertStatus(200);
});
