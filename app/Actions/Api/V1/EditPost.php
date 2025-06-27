<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Post;
use App\Payloads\Api\V1\PostPayload;
use Illuminate\Support\Facades\DB;

final readonly class EditPost
{
    public function __construct(
        private SaveImage $action
    ) {}

    public function handle(Post $post, PostPayload $payload): Post
    {
        return DB::transaction(function () use ($post, $payload): Post {

            match ($payload->getImage()) {
                null => null,
                default => $this->action->handle(
                    $post, $payload->getImage()
                )
            };

            $post->update($payload->toArray());

            $post->tags()->sync($payload->getTags());

            return $post;
        });
    }
}
