<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\AuthenticationFailure;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Responses\Api\TokenResponse;
use App\Services\Api\Auth\IdentityService;
use Symfony\Component\HttpFoundation\Response;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $service
    ) {}

    public function __invoke(LoginRequest $request): TokenResponse
    {
        if (! $this->service->login($request->payload())) {
            throw new AuthenticationFailure(
                message: 'Invalid Credentials',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        return new TokenResponse(
            token: $this->service->createToken()
        );
    }
}
