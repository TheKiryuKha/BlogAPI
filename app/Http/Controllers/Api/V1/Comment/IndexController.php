<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController
{
    public function __invoke(): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Comment::class);

        return CommentResource::collection(
            resource: QueryBuilder::for(Comment::class)
                ->allowedIncludes(['post', 'user'])->paginate(10)
        );
    }
}
