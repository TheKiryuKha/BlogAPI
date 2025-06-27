<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

final class CategoryPolicy
{
    public function create(User $user): bool
    {
        if ($user->tokenCan('author') && $user->role === UserRole::Author) {
            return true;
        }

        if ($user->tokenCan('admin') && $user->role === UserRole::Admin) {
            return true;
        }

        return false;
    }
}
