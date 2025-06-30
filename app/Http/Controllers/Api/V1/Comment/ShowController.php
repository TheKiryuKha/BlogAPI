<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use Spatie\QueryBuilder\QueryBuilder;

final class ShowController
{
    public function __invoke(Comment $comment): CommentResource
    {
        return new CommentResource(
            resource: QueryBuilder::for(
                subject: Comment::where('id', $comment->id)
            )->allowedIncludes(['post', 'user'])->first()
        );
    }
}
