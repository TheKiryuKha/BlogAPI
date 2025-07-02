<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Queries\Contracts\FetchRelationsContract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class IndexController
{
    public function __invoke(FetchRelationsContract $query): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Comment::class);

        $comments = $query->handle(
            query: Comment::query(),
            relations: ['post', 'user']
        );

        return CommentResource::collection(
            resource: $comments->paginate(10)
        );
    }
}
