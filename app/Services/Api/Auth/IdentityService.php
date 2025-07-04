<?php

declare(strict_types=1);

namespace App\Services\Api\Auth;

use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\Auth\LoginPayload;
use Illuminate\Auth\AuthManager;
use Laravel\Sanctum\NewAccessToken;

final readonly class IdentityService
{
    public function __construct(
        private AuthManager $auth
    ) {}

    public function login(LoginPayload $payload): bool
    {
        return $this->auth->attempt(
            credentials: $payload->toArray()
        );
    }

    public function createToken(): NewAccessToken
    {
        /** @var User $user */
        $user = $this->auth->user();

        return $user->createToken(
            name: $user->name,
            abilities: $this->getRoleAbilities($user)
        );
    }

    /**
     * @return string[]
     */
    private function getRoleAbilities(User $user): array
    {
        return match ($user->role) {
            UserRole::Reader => ['reader'],
            UserRole::Author => ['author'],
            UserRole::Admin => ['admin']
        };
    }
}
