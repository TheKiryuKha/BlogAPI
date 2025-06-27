<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Actions\Api\V1\BulkCreateCategories;
use App\Http\Requests\Api\V1\Category\BulkStoreRequest;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class BulkStoreController
{
    public function __invoke(BulkStoreRequest $request, BulkCreateCategories $action): AnonymousResourceCollection
    {
        Gate::authorize('create', Category::class);

        return CategoryResource::collection(
            resource: $action->handle($request->payload())
        );
    }
}
