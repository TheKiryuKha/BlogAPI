<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;

beforeEach(fn () => $this->post = Post::factory()->create());

it('returns the correct code if unauthentitficated', function () {
    $this->getJson(
        route('api:v1:posts:show', $this->post)
    )->assertStatus(
        401
    );
});

it('returns the correct code if authentitficated', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:posts:show', $this->post)
    )->assertStatus(
        200
    );
});
