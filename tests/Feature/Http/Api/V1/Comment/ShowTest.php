<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\User;

beforeEach(fn () => $this->comment = Comment::factory()->create());

it('returns the correct code if unauthentitficated', function () {
    $this->getJson(
        route('api:v1:comments:show', $this->comment)
    )->assertStatus(
        401
    );
});

it('returns the correct code if authentitficated but not admin', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:comments:show', $this->comment)
    )->assertStatus(
        200
    );
});
