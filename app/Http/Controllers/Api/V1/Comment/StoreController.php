<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Http\Requests\Api\V1\Comment\StoreRequest;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

final class StoreController
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        return response()->json(
            data: new CommentResource(
                resource: Comment::create(
                    attributes: $request->payload()->toArray()
                )
            ),
            status: 201
        );
    }
}
