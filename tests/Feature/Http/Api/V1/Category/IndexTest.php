<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(fn () => $this->category = Category::factory()->create());

test('index endpoint', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('api:v1:categories:index'))
        ->assertStatus(200)
        ->assertJson(function (AssertableJson $json) {
            $json->has('data', 2)
                ->has('data.1', function (AssertableJson $json) {
                    $json->where('id', $this->category->id)
                        ->where('type', 'category')
                        ->where('attributes.title', $this->category->title)
                        ->where('relationships', [])
                        ->where('links.self', route('api:v1:categories:show', $this->category))
                        ->where('links.parent', route('api:v1:categories:index'));
                })
                ->etc();
        });
});
