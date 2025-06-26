<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Requests\Api\V1\Category\StoreRequest;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

final class StoreController
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        return response()->json(
            data: new CategoryResource(
                resource: Category::create(
                    attributes: $request->payload()->toArray()
                )
            ),
            status: 201
        );
    }
}
