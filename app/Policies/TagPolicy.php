<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class TagPolicy
{
    public function create(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isAuthor();
    }

    public function update(User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user): bool
    {
        return $user->isAuthor();
    }
}
