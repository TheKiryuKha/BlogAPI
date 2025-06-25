<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Requests\Api\V1\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

final class StoreController
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        Tag::factory()->create(
            $request->payload()->toArray()
        );

        return response()->json(
            data: [
                'message' => 'Category created succesfully',
            ], status: 200
        );
    }
}
