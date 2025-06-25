<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Actions\Api\V1\CreateCategory;
use App\Http\Requests\Api\V1\Category\StoreRequest;
use Illuminate\Http\JsonResponse;

final class StoreController
{
    public function __invoke(CreateCategory $action, StoreRequest $request): JsonResponse
    {
        $action->handle($request->payload());

        return response()->json(
            data: [
                'message' => 'Category created succesfully',
            ],
            status: 200
        );
    }
}
