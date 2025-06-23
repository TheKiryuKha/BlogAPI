<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

test('show endpoint', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $this->actingAs($user)
        ->get(route('api:v1:categories:show', $category))
        ->assertStatus(200);
});
