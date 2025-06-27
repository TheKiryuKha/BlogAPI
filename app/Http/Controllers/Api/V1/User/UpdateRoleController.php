<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Enums\UserRole;
use App\Http\Requests\Api\V1\User\UpdateRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class UpdateRoleController
{
    public function __invoke(User $user, UpdateRequest $request): UserResource
    {
        Gate::authorize('updateRole', User::class);

        $user->update([
            'role' => $request->enum('role', UserRole::class),
        ]);

        return new UserResource($user);
    }
}
