<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

beforeEach(fn () => $this->category = Category::factory()->create());

it('returns the correct code if unauthentitficated', function () {
    $this->getJson(
        route('api:v1:categories:show', $this->category)
    )->assertStatus(
        401
    );
});

it('returns the correct code if authentitficated', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:v1:categories:show', $this->category)
    )->assertStatus(
        200
    );
});
