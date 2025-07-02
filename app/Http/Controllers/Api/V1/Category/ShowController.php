<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use App\Queries\Contracts\FetchRelationsContract;

final class ShowController
{
    public function __invoke(Category $category, FetchRelationsContract $query): CategoryResource
    {
        $category = $query->handle(
            query: Category::query()->where('id', $category->id),
            relations: ['posts']
        );

        return new CategoryResource(
            resource: $category->first()
        );
    }
}
