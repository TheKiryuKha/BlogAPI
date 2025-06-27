<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Requests\Api\V1\Tag\UpdateRequest;
use App\Http\Resources\Api\V1\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class UpdateController
{
    public function __invoke(Tag $tag, UpdateRequest $request): JsonResponse
    {
        Gate::authorize('update', Tag::class);

        return response()->json(
            data: new TagResource(
                resource: $tag->update(
                    attributes: $request->payload()->toArray()
                )
            )
        );
    }
}
