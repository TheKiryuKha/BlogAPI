<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use Spatie\QueryBuilder\QueryBuilder;

final class ShowController
{
    public function __invoke(Post $post): PostResource
    {
        return new PostResource(
            resource: QueryBuilder::for(
                subject: Post::where('id', $post->id)
            )->allowedIncludes(['user', 'category', 'tags', 'comments'])->first()
        );
    }
}
