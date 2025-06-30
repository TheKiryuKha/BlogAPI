<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;

final class DestroyController
{
    public function __invoke(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json(status: 204);
    }
}
