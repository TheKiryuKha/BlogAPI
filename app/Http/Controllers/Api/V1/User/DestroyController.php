<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class DestroyController
{
    public function __invoke(User $user): JsonResponse
    {
        if (Gate::denies('update-user', $user)) {
            abort(403);
        }

        $user->posts()->each(function (Post $post) {
            $post->comments()->delete();
            $post->tags()->detach();
            $post->delete();
        });

        $user->comments()->delete();

        $user->delete();

        return response()->json(status: 204);
    }
}
