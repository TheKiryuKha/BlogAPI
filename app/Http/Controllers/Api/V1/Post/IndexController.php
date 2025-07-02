<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use App\Queries\Contracts\PostQueryContract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController
{
    public function __invoke(PostQueryContract $query): AnonymousResourceCollection
    {
        $posts = $query->handle(
            query: Post::query()
        );

        return PostResource::collection(
            resource: $posts->paginate(10)
        );
    }
}
