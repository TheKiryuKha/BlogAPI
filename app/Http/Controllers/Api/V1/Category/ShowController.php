<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;

final class ShowController
{
    public function __invoke(Category $category): CategoryResource
    {
        return new CategoryResource(
            resource: QueryBuilder::for(
                subject: Category::where('id', $category->id)
            )->allowedIncludes(['posts'])->first()
        );
    }
}
