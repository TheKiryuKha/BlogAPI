<?php

declare(strict_types=1);

use App\Http\Resources\Api\V1\DateResource;
use App\Models\Category;

it('returns right data', function () {
    $category = Category::factory()->create();
    $resource = new DateResource($category->created_at);

    expect($resource->toArray(request()))->toEqual([
        'human' => $category->created_at->diffForHumans(),
        'string' => $category->created_at->toDateTimeString(),
        'local' => $category->created_at->toDateTimeLocalString(),
        'timestamp' => $category->created_at->timestamp,
    ]);
});
