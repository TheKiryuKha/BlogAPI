<?php

declare(strict_types=1);

namespace App\Actions\Api\V1;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class DeleteUser
{
    public function __construct(
        private DeletePost $action
    ) {}

    public function handle(User $user): bool
    {
        return DB::transaction(function () use ($user): true {

            $user->posts()->each(
                fn (Post $post): bool => $this->action->handle(
                    post: $post
                )
            );

            $user->comments()->delete();

            $user->delete();

            return true;
        });
    }
}
