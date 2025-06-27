<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Actions\Api\V1\DeleteCategory;
use App\Models\Category;
use Gate;
use Illuminate\Http\JsonResponse;

final class DestroyController
{
    public function __invoke(Category $category, DeleteCategory $action): JsonResponse
    {
        Gate::authorize('delete', Category::class);

        $action->handle($category);

        return response()->json(status: 204);
    }
}
