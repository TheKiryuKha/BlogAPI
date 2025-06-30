<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class DestroyController
{
    public function __invoke(Comment $comment): JsonResponse
    {
        Gate::authorize('destroy', $comment);

        $comment->delete();

        return response()->json(status: 204);
    }
}
