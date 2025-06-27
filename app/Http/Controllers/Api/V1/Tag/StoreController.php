<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Requests\Api\V1\Tag\StoreRequest;
use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Gate;
use Illuminate\Http\JsonResponse;

final class StoreController
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        Gate::authorize('create', Tag::class);

        return response()->json(
            data: new TagResource(
                resource: Tag::create(
                    attributes: $request->payload()->toArray()
                )
            ),
            status: 201
        );
    }
}
