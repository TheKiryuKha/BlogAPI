<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Actions\Api\V1\DeleteUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class DestroyController
{
    public function __invoke(User $user, DeleteUser $action): JsonResponse
    {
        Gate::authorize('delete', $user);

        $action->handle($user);

        return response()->json(status: 204);
    }
}
