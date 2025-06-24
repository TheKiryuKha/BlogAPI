<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

test('index endpoint', function () {
    $category = Category::factory()->create();

    $response = $this->actingAs($this->user)
        ->getJson(route('api:v1:categories:show', $category));

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['title', 'created'],
                'relationships' => [],
                'links' => ['self', 'parent'],
            ],
        ]);
});

test('index endpoint with include posts', function () {
    $category = Category::factory()->create();

    $response = $this->actingAs($this->user)
        ->getJson(
            route(
                'api:v1:categories:show',
                [
                    'category' => $category,
                    'include' => 'posts',
                ]
            )
        );

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => ['title', 'created'],
                'relationships' => [
                    'posts' => [
                        '*' => [
                            'id',
                            'type',
                            'attributes' => ['title', 'content', 'slug', 'status', 'created'],
                            'relationships' => [],
                            'links' => [],
                        ],
                    ],
                ],
                'links' => ['self', 'parent'],
            ],
        ]);
});
