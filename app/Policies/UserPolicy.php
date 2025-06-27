<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $tagtet_user): bool
    {
        return $user->id === $tagtet_user->id;
    }

    public function updateRole(User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, User $taget_user): bool
    {
        return $user->id === $taget_user->id || $user->isAdmin();
    }
}
