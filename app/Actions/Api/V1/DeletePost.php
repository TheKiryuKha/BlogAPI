<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

final readonly class DeletePost
{
    public function handle(Post $post): bool
    {
        return DB::transaction(function () use ($post): true {

            $post->comments()->delete();

            $post->tags()->detach();

            $post->delete();

            return true;
        });
    }
}
