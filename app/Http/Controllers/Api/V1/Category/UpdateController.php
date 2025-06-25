<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Requests\Api\V1\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class UpdateController
{
    public function __invoke(Category $category, UpdateRequest $request): JsonResponse
    {
        $category->update(
            $request->payload()->toArray()
        );

        return response()->json(
            data: [
                'message' => 'category updated succesfully'
            ]
        );
    }
}
