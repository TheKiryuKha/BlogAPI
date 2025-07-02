<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Queries\FetchRealtions;

final class ShowController
{
    public function __invoke(Comment $comment, FetchRealtions $query): CommentResource
    {
        $comment = $query->handle(
            query: Comment::query()->where('id', $comment->id),
            relations: ['post', 'user']
        );

        return new CommentResource(
            resource: $comment->first()
        );
    }
}
