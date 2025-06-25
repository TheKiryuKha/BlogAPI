<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Actions\Api\V1\DeleteCategory;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Category;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class DestroyController
{
    public function __invoke(Category $category, DeleteCategory $action): AnonymousResourceCollection
    {
        if(Gate::denies('is-admin')){   abort(403);  }

        return PostResource::collection(
            resource: $action->handle($category)
        );
    }
}
