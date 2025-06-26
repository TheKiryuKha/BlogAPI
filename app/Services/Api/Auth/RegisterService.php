<?php

declare(strict_types=1);

namespace App\Services\Api\Auth;

use App\Enums\UserRole;
use App\Models\User;
use App\Payloads\Api\Auth\RegisterPayload;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\NewAccessToken;

final readonly class RegisterService
{
    public function __construct(
        private AuthManager $auth
    ) {}

    public function register(RegisterPayload $payload): bool
    {
        $this->createUser($payload);

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
            abilities: [UserRole::Reader]
        );
    }

    private function createUser(RegisterPayload $payload): User
    {
        $user = User::create(
            attributes: $payload->toArray()
        );

        $this->createAvatarForUser($user);

        return $user;
    }

    private function createAvatarForUser(User $user): void
    {
        $path = Storage::disk('public')->path('default_image.png');

        $user->addMedia($path)
            ->preservingOriginal()
            ->toMediaCollection();
    }
}
