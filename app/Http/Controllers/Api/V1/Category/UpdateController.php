<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Requests\Api\V1\Category\UpdateRequest;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

final class UpdateController
{
    public function __invoke(Category $category, UpdateRequest $request): CategoryResource
    {
        Gate::authorize('update', $category);

        return new CategoryResource(
            resource: $category->update(
                attributes: $request->payload()->toArray()
            )
        );
    }
}
