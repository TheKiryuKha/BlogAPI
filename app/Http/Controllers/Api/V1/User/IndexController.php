<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController
{
    public function __invoke(): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', User::class);

        return UserResource::collection(
            resource: QueryBuilder::for(
                subject: User::class
            )->allowedIncludes(['posts', 'comments'])
                ->paginate(10)
        );
    }
}
