<?php

declare(strict_types=1);

use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\DateResource;
use App\Models\Category;

it('returns right array', function () {
    $category = Category::factory()->create();
    $resource = new CategoryResource($category);

    $data = $resource->toArray(request());

    $this->assertArrayHasKey('id', $data);
    $this->assertArrayHasKey('type', $data);
    $this->assertArrayHasKey('attributes', $data);
    $this->assertArrayHasKey('relationships', $data);
    $this->assertArrayHasKey('links', $data);

    $this->assertEquals($category->id, $data['id']);
    $this->assertEquals('category', $data['type']);
    $this->assertEquals(
        [
            'title' => $category->title,
            'created' => new DateResource(
                $category->created_at
            ),
        ],
        $data['attributes']
    );

});
