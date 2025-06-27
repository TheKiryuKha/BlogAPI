<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class DeleteUser
{
    public function handle(User $user): bool
    {
        return DB::transaction(function () use ($user): true {

            $user->posts()->each(function (Post $post): void {
                $post->comments()->delete();
                $post->tags()->detach();
                $post->delete();
            });

            $user->comments()->delete();

            $user->delete();

            return true;
        });
    }
}
