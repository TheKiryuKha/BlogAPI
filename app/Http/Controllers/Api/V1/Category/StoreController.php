<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Requests\Api\V1\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

final class StoreController
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        Category::create(
            $request->payload()->toArray()
        );

        return response()->json(
            data: [
                'message' => 'Category created succesfully',
            ], status: 200
        );
    }
}
