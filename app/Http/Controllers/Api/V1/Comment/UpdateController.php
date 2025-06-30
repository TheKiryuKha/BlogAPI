<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comment;

use App\Http\Requests\Api\V1\Comment\UpdateRequest;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;

final class UpdateController
{
    public function __invoke(Comment $comment, UpdateRequest $request): CommentResource
    {
        $comment->update(
            $request->payload()->toArray()
        );

        return new CommentResource($comment);
    }
}
