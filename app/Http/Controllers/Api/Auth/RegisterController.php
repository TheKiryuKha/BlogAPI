<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Responses\Api\TokenResponse;
use App\Services\Api\Auth\RegisterService;

final readonly class RegisterController
{
    public function __construct(
        private RegisterService $service
    ) {}

    public function __invoke(RegisterRequest $request): TokenResponse
    {
        $this->service->register($request->payload());

        return new TokenResponse(
            token: $this->service->createToken()
        );
    }
}
