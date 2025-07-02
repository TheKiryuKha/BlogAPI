<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Queries\Contracts\UserQueryContract;

final class ShowController
{
    public function __invoke(User $user, UserQueryContract $query): UserResource
    {
        $user = $query->handle(
            query: User::query()->where('id', $user->id)
        );

        return new UserResource(
            resource: $user->first()
        );
    }
}
