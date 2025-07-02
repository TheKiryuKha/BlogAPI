<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use App\Queries\Contracts\FetchRelationsContract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController
{
    public function __invoke(FetchRelationsContract $query): AnonymousResourceCollection
    {
        $categories = $query->handle(
            query: Category::query(),
            relations: ['posts']
        );

        return CategoryResource::collection(
            resource: $categories->paginate(10)
        );
    }
}
