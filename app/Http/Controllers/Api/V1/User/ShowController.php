<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Queries\FetchRealtions;

final class ShowController
{
    public function __invoke(User $user, FetchRealtions $query): UserResource
    {
        $user = $query->handle(
            query: User::query()->where('id', $user->id),
            relations: ['posts', 'comments']
        );

        return new UserResource(
            resource: $user->first()
        );
    }
}
