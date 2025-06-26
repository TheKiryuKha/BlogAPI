<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

final class ShowController
{
    public function __invoke(User $user): UserResource
    {
        return new UserResource(
            resource: QueryBuilder::for(
                subject: User::where('id', $user->id)
            )->allowedIncludes(['posts'])->first()
        );
    }
}
