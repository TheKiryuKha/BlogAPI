<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\NewAccessToken;

final readonly class TokenResponse implements Responsable
{
    public function __construct(
        private NewAccessToken $token
    ) {}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                'token' => $this->token->plainTextToken,
            ]
        );
    }
}
