<?php

declare(strict_types=1);

use App\Models\User;

test('user can delete all his tokens', function () {
    $user = User::factory()->create();
    $user->createToken($user->name);

    $this->actingAs($user)
        ->post(route('api:auth:logout'))
        ->assertStatus(200);

    expect($user->tokens)->toBeEmpty();
});
