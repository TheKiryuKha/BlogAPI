<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

final class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id || $user->isAdmin();
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id || $user->isAdmin();
    }
}
