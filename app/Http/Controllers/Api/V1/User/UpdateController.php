<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Actions\Api\V1\EditUser;
use App\Http\Requests\Api\V1\User\UpdateRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class UpdateController
{
    public function __invoke(User $user, EditUser $action, UpdateRequest $request): UserResource
    {
        Gate::authorize('update', $user);

        return new UserResource(
            resource: $action->handle(
                user: $user,
                payload: $request->payload()
            )
        );
    }
}
