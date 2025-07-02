<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Queries\Contracts\UserQueryContract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class IndexController
{
    public function __invoke(UserQueryContract $query): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', User::class);

        $users = $query->handle(
            query: User::query()
        );

        return UserResource::collection(
            resource: $users->paginate(10)
        );
    }
}
