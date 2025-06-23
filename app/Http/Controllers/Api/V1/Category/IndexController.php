<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            resource: Category::paginate(10)
        );
    }
}
