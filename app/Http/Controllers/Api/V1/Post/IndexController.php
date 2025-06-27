<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController
{
    public function __invoke(): AnonymousResourceCollection
    {
        return PostResource::collection(
            resource: QueryBuilder::for(
                subject: Post::class
            )->allowedIncludes(['user', 'category', 'tags', 'comments'])
                ->paginate(10)
        );
    }
}
