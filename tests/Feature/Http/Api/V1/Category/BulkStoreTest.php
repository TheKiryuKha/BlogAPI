<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

test('user(author) can bulk create categories', function () {
    $user = User::factory()->author()->create();
    $categories = [
        [
            'title' => 'test1',
        ],
        [
            'title' => 'test2',
        ],
        [
            'title' => 'test3',
        ],
    ];

    $this->actingAs($user)
        ->post(route('api:v1:categories:bulkStore'), $categories)
        ->assertStatus(201);

    expect(Category::count())->toBe(4);

});

test('user(admin) can bulk create categories', function () {
    $user = User::factory()->admin()->create();
    $categories = [
        [
            'title' => 'test1',
        ],
        [
            'title' => 'test2',
        ],
        [
            'title' => 'test3',
        ],
    ];

    $this->actingAs($user)
        ->post(route('api:v1:categories:bulkStore'), $categories)
        ->assertStatus(201);

    expect(Category::count())->toBe(4);

});

test('user(reader) cannot bulk create categories', function () {
    $user = User::factory()->create();
    $categories = [
        [
            'title' => 'test1',
        ],
        [
            'title' => 'test2',
        ],
        [
            'title' => 'test3',
        ],
    ];

    $this->actingAs($user)
        ->post(route('api:v1:categories:bulkStore'), $categories)
        ->assertStatus(403);
});
