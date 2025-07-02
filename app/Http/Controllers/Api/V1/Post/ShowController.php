<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use App\Queries\Contracts\PostQueryContract;

final class ShowController
{
    public function __invoke(Post $post, PostQueryContract $query): PostResource
    {
        $post = $query->handle(
            query: Post::query()->where('id', $post->id)
        );

        return new PostResource(
            resource: $post->first()
        );
    }
}
