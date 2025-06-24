<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController
{
    public function __invoke(): AnonymousResourceCollection
    {
        $posts = QueryBuilder::for(
            Category::class
        )->allowedIncludes(['posts'])->paginate(10);

        return CategoryResource::collection(
            $posts
        );
    }
}
