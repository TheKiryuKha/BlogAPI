<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Post;
use App\Payloads\Api\V1\PostPayload;
use Illuminate\Support\Facades\DB;

final readonly class CreatePost
{
    public function __construct(
        private SaveImage $action
    ) {}

    public function handle(PostPayload $payload): Post
    {
        return DB::transaction(function () use ($payload) {
            $post = Post::create($payload->toArray());

            match ($payload->getImage()) {
                null => null,
                default => $this->action->handle(
                    model: $post, image: $payload->getImage()
                )
            };

            return $post;
        });
    }
}
