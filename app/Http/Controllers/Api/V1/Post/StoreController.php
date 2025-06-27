<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Actions\Api\V1\CreatePost;
use App\Http\Requests\Api\V1\Post\StoreRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class StoreController
{
    public function __invoke(StoreRequest $request, CreatePost $action): JsonResponse
    {
        Gate::authorize('create', Post::class);

        return response()->json(
            data: new PostResource(
                resource: $action->handle(
                    payload: $request->payload()
                )
            ),
            status: 201
        );
    }
}
