<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;

final class LogoutController
{
    public function __invoke(): JsonResponse
    {
        /** @var User $user */
        $user = request()->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => 'all tokens deleted succusfully',
        ]);
    }
}
