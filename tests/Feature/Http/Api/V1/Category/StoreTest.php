<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

test('user(author) can store category', function () {
    $user = User::factory()->author()->create();

    $this->actingAs($user)
        ->post(route('api:v1:categories:store', [
            'title' => 'Test',
        ]))
        ->assertStatus(200);

    expect(Category::count())->toBe(2)
        ->and(Category::all()[1]->title)->toBe('Test');
});

test('user(admin) can store category', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->post(route('api:v1:categories:store', [
            'title' => 'Test',
        ]))
        ->assertStatus(200);

    expect(Category::count())->toBe(2)
        ->and(Category::all()[1]->title)->toBe('Test');
});

test('user(reader) cannot store category', function () {
    $user = User::factory()->create();
    $token = $user->createToken('reader', ['reader']);

    $this->withToken($token->plainTextToken)
        ->post(route('api:v1:categories:store', [
            'title' => 'Test',
        ]))
        ->assertStatus(403);
});
