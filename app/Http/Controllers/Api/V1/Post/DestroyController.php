<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Actions\Api\V1\DeletePost;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class DestroyController
{
    public function __invoke(Post $post, DeletePost $action): JsonResponse
    {
        Gate::authorize('delete', $post);

        $action->handle($post);

        return response()->json(status: 204);
    }
}
