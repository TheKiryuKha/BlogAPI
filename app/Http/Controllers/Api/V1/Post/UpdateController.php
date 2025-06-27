<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Actions\Api\V1\EditPost;
use App\Http\Requests\Api\V1\Post\UpdateRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

final class UpdateController
{
    public function __invoke(Post $post, EditPost $action, UpdateRequest $request): PostResource
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }

        return new PostResource(
            resource: $action->handle(
                post: $post,
                payload: $request->payload()
            )
        );
    }
}
