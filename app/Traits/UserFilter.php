<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\UserRole;

trait UserFilter
{
    public function isAdmin(): bool
    {
        return $this->tokenCan('admin') && $this->role === UserRole::Admin;
    }

    public function isAuthor(): bool
    {
        return $this->tokenCan('author') && $this->role === UserRole::Author;
    }

    public function isReader(): bool
    {
        return $this->tokenCan('reader') && $this->role === UserRole::Reader;
    }
}
